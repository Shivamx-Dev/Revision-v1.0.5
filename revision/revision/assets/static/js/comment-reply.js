/** ----------------------------------------------------------------------------
 * Comment Reply */

/* jshint ignore:start */

/**
 * Handles the addition of the comment form.
 *
 * @since 2.7.0
 * @output wp-includes/js/comment-reply.js
 *
 * @namespace addComment
 *
 * @type {Object}
 */
window.addComment = ( function ( window ) {
	// Avoid scope lookups on commonly used variables.
	var document = window.document;

	// Settings.
	var config = {
		commentReplyClass   : 'comment-reply-link',
		commentReplyTitleId : 'reply-title',
		cancelReplyId       : 'cancel-comment-reply-link',
		commentFormId       : 'commentform',
		temporaryFormClass  : 'wp-temp-form-div',
		parentIdFieldId     : 'comment_parent',
		postIdFieldId       : 'comment_post_ID',
		commentsWrap        : 'comments',
	};

	// Cross browser MutationObserver.
	var MutationObserver = window.MutationObserver || window.WebKitMutationObserver || window.MozMutationObserver;

	// Check browser cuts the mustard.
	var cutsTheMustard = 'querySelector' in document && 'addEventListener' in window;

	/*
	 * Check browser supports dataset.
	 * !! sets the variable to true if the property exists.
	 */
	var supportsDataset = ! ! document.documentElement.dataset;

	// For holding the cancel element.
	var cancelElement;

	// For holding the comment form element.
	var commentFormElement;

	// The respond element.
	var respondElement;

	// The mutation observer.
	var observer;

	if ( cutsTheMustard && document.readyState !== 'loading' ) {
		ready();
	} else if ( cutsTheMustard ) {
		window.addEventListener( 'DOMContentLoaded', ready, false );
	}

	/**
	 * Sets up object variables after the DOM is ready.
	 *
	 * @since 5.1.1
	 */
	function ready() {
		// Initialize the events.
		init();

		// Set up a MutationObserver to check for comments loaded late.
		observeChanges();
	}

	/**
	 * Add events to links classed .comment-reply-link.
	 *
	 * Searches the context for reply links and adds the JavaScript events
	 * required to move the comment form. To allow for lazy loading of
	 * comments this method is exposed as window.commentReply.init().
	 *
	 * @since 5.1.0
	 *
	 * @memberOf addComment
	 *
	 * @param {HTMLElement} context The parent DOM element to search for links.
	 */
    function init(context) {
        if (!cutsTheMustard) {
            return;
        }

        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.1,
        };

        let currentPost = null;

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    const post = entry.target;

                    if (currentPost !== post) {
                        currentPost = post;

                        cancelElement = post.querySelector(`#${config.cancelReplyId}`);
                        commentFormElement = post.querySelector(`#${config.commentFormId}`);

                        if (cancelElement) {
                            cancelElement.addEventListener('click', cancelEvent);
                        }

                        if (commentFormElement) {
                            const submitFormHandler = function (e) {
                                if ((e.metaKey || e.ctrlKey) && e.keyCode === 13) {
                                    commentFormElement.removeEventListener('keydown', submitFormHandler);
                                    e.preventDefault();
                                    commentFormElement.submit.click();
                                    return false;
                                }
                            };

                            commentFormElement.addEventListener('keydown', submitFormHandler);
                        }

                        updateCancelReplyLink(post);

                        const links = replyLinks(post);
                        if (links) {
                            Array.from(links).forEach((link) => {
                                link.addEventListener('click', clickEvent);
                            });
                        }
                    }
                }
            });
        }, observerOptions);

        const posts = document.querySelectorAll('#' + config.commentsWrap );
        posts.forEach((post) => {
            observer.observe(post);
        });
    }
	/**
	 * Return all links classed .comment-reply-link.
	 *
	 * @since 5.1.0
	 *
	 * @param {HTMLElement} context The parent DOM element to search for links.
	 *
	 * @return {HTMLCollection|NodeList|Array}
	 */
	function replyLinks( context ) {
		var selectorClass = config.commentReplyClass;
		var allReplyLinks;

		if ( ! context || ! context.childNodes ) {
			context = document;
		}

		if ( document.getElementsByClassName ) {
			allReplyLinks = context.getElementsByClassName( selectorClass );
		} else {
			allReplyLinks = context.querySelectorAll( '.' + selectorClass );
		}

		return allReplyLinks;
	}

    function updateCancelReplyLink( postElement ) {
        const cancelLink  = postElement.querySelector(`#${config.cancelReplyId}`);
        const postIdField = postElement.querySelector(`#${config.postIdFieldId}`);
        const postId      = postIdField ? postIdField.value : null;

        if (cancelLink && postId) {
            const currentPostUrl = `${window.location.origin}${window.location.pathname}#respond-${postId}`;
            cancelLink.setAttribute('href', currentPostUrl);
        }
    }

	/**
	 * Cancel event handler.
	 *
	 * @since 5.1.0
	 *
	 * @param {Event} event The calling event.
	 */
	function cancelEvent( event ) {
		var cancelLink          = this;
        var commentsWrapElement = event.target.closest( '#' + config.commentsWrap );
		var temporaryElement    = commentsWrapElement.querySelector( '.' + config.temporaryFormClass );

		if ( ! temporaryElement || ! respondElement ) {
			// Conditions for cancel link fail.
			return;
		}

		commentsWrapElement.querySelector( '#' + config.parentIdFieldId ).value = 0;

		// Move the respond form back in place of the temporary element.
		var headingText = temporaryElement.textContent;
		temporaryElement.parentNode.replaceChild( respondElement, temporaryElement );
		cancelLink.style.display = 'none';

		var replyHeadingElement  = commentsWrapElement.querySelector( '#' + config.commentReplyTitleId );
		var replyHeadingTextNode = replyHeadingElement && replyHeadingElement.firstChild;
		var replyLinkToParent    = replyHeadingTextNode && replyHeadingTextNode.nextSibling;

		if ( replyHeadingTextNode && replyHeadingTextNode.nodeType === Node.TEXT_NODE && headingText ) {
			if ( replyLinkToParent && 'A' === replyLinkToParent.nodeName && replyLinkToParent.id !== config.cancelReplyId ) {
				replyLinkToParent.style.display = '';
			}

			replyHeadingTextNode.textContent = headingText;
		}

		event.preventDefault();
	}

	/**
	 * Click event handler.
	 *
	 * @since 5.1.0
	 *
	 * @param {Event} event The calling event.
	 */
	function clickEvent( event ) {
        var commentsWrapElement = event.target.closest( '#' + config.commentsWrap );
		var replyNode           = commentsWrapElement.querySelector( '#' + config.commentReplyTitleId );
		var defaultReplyHeading = replyNode && replyNode.firstChild.textContent;
		var replyLink           = this,
			commId              = getDataAttribute( replyLink, 'belowelement' ),
			parentId            = getDataAttribute( replyLink, 'commentid' ),
			respondId           = getDataAttribute( replyLink, 'respondelement' ),
			postId              = getDataAttribute( replyLink, 'postid' ),
			replyTo             = getDataAttribute( replyLink, 'replyto' ) || defaultReplyHeading,
			follow;

		if ( ! commId || ! parentId || ! respondId || ! postId ) {
			/*
			 * Theme or plugin defines own link via custom `wp_list_comments()` callback
			 * and calls `moveForm()` either directly or via a custom event hook.
			 */
			return;
		}

		/*
		 * Third party comments systems can hook into this function via the global scope,
		 * therefore the click event needs to reference the global scope.
		 */
		follow = window.addComment.moveForm( commId, parentId, respondId, postId, replyTo, event );
		if ( false === follow ) {
			event.preventDefault();
		}
	}

	/**
	 * Creates a mutation observer to check for newly inserted comments.
	 *
	 * @since 5.1.0
	 */
	function observeChanges() {
		if ( ! MutationObserver ) {
			return;
		}

		var observerOptions = {
			childList: true,
			subtree: true
		};

		observer = new MutationObserver( handleChanges );
		observer.observe( document.body, observerOptions );
	}

	/**
	 * Handles DOM changes, calling init() if any new nodes are added.
	 *
	 * @since 5.1.0
	 *
	 * @param {Array} mutationRecords Array of MutationRecord objects.
	 */
	function handleChanges( mutationRecords ) {
		var i = mutationRecords.length;

		while ( i-- ) {
			// Call init() once if any record in this set adds nodes.
			if ( mutationRecords[ i ].addedNodes.length ) {
				init();
				return;
			}
		}
	}

	/**
	 * Backward compatible getter of data-* attribute.
	 *
	 * Uses element.dataset if it exists, otherwise uses getAttribute.
	 *
	 * @since 5.1.0
	 *
	 * @param {HTMLElement} Element DOM element with the attribute.
	 * @param {string}      Attribute the attribute to get.
	 *
	 * @return {string}
	 */
	function getDataAttribute( element, attribute ) {
		if ( supportsDataset ) {
			return element.dataset[attribute];
		} else {
			return element.getAttribute( 'data-' + attribute );
		}
	}

	/**
	 * Get element by ID.
	 *
	 * Local alias for document.getElementById.
	 *
	 * @since 5.1.0
	 *
	 * @param {HTMLElement} The requested element.
	 */
	function getElementById( elementId ) {
		return document.getElementById( elementId );
	}

	/**
	 * Moves the reply form from its current position to the reply location.
	 *
	 * @since 2.7.0
	 *
	 * @memberOf addComment
	 *
	 * @param {string} addBelowId HTML ID of element the form follows.
	 * @param {string} commentId  Database ID of comment being replied to.
	 * @param {string} respondId  HTML ID of 'respond' element.
	 * @param {string} postId     Database ID of the post.
	 * @param {string} replyTo    Form heading content.
	 */
	function moveForm( addBelowId, commentId, respondId, postId, replyTo, event ) {
		// Get elements based on their IDs.
		var commentsWrapElement = event.target.closest( '#' + config.commentsWrap );

		var addBelowElement = commentsWrapElement.querySelector( '#' + addBelowId );
		respondElement      = commentsWrapElement.querySelector( '#' + respondId );
		// Get the hidden fields.
		var parentIdField = commentsWrapElement.querySelector( '#' + config.parentIdFieldId );
		var postIdField   = commentsWrapElement.querySelector( '#' + config.postIdFieldId );
		var element, cssHidden, style;

		var replyHeading         = commentsWrapElement.querySelector( '#' + config.commentReplyTitleId );
		var replyHeadingTextNode = replyHeading && replyHeading.firstChild;
		var replyLinkToParent    = replyHeadingTextNode && replyHeadingTextNode.nextSibling;

		if ( ! addBelowElement || ! respondElement || ! parentIdField ) {
			// Missing key elements, fail.
			return;
		}

		if ( 'undefined' === typeof replyTo ) {
			replyTo = replyHeadingTextNode && replyHeadingTextNode.textContent;
		}

		addPlaceHolder( respondElement, event );

		// Set the value of the post.
		if ( postId && postIdField ) {
			postIdField.value = postId;
		}

		parentIdField.value         = commentId;
		cancelElement.style.display = '';
		addBelowElement.querySelector( '.comment-body' ).insertBefore( respondElement, null );

		if ( replyHeadingTextNode && replyHeadingTextNode.nodeType === Node.TEXT_NODE ) {
			if ( replyLinkToParent && 'A' === replyLinkToParent.nodeName && replyLinkToParent.id !== config.cancelReplyId ) {
				replyLinkToParent.style.display = 'none';
			}

			replyHeadingTextNode.textContent = replyTo;
		}

		/*
		 * This is for backward compatibility with third party commenting systems
		 * hooking into the event using older techniques.
		 */
		cancelElement.onclick = function () {
			return false;
		};

		// Focus on the first field in the comment form.
		try {
			for ( var i = 0; i < commentFormElement.elements.length; i++ ) {
				element   = commentFormElement.elements[i];
				cssHidden = false;

				// Get elements computed style.
				if ( 'getComputedStyle' in window ) {
					// Modern browsers.
					style = window.getComputedStyle( element );
				} else if ( document.documentElement.currentStyle ) {
					// IE 8.
					style = element.currentStyle;
				}

				/*
				 * For display none, do the same thing jQuery does. For visibility,
				 * check the element computed style since browsers are already doing
				 * the job for us. In fact, the visibility computed style is the actual
				 * computed value and already takes into account the element ancestors.
				 */
				if ( ( element.offsetWidth <= 0 && element.offsetHeight <= 0 ) || style.visibility === 'hidden' ) {
					cssHidden = true;
				}

				// Skip form elements that are hidden or disabled.
				if ( 'hidden' === element.type || element.disabled || cssHidden ) {
					continue;
				}

				element.focus();
				// Stop after the first focusable element.
				break;
			}
		} catch (e) {

		}

		/*
		 * false is returned for backward compatibility with third party commenting systems
		 * hooking into this function.
		 */
		return false;
	}

	/**
	 * Add placeholder element.
	 *
	 * Places a place holder element above the #respond element for
	 * the form to be returned to if needs be.
	 *
	 * @since 2.7.0
	 *
	 * @param {HTMLelement} respondElement the #respond element holding comment form.
	 */
	function addPlaceHolder( respondElement, event ) {
        var commentsWrapElement = event.target.closest( '#' + config.commentsWrap );
		var temporaryElement   = commentsWrapElement.querySelector( '.' + config.temporaryFormClass );
		var replyElement       = respondElement.querySelector( '#' + config.commentReplyTitleId );
		var initialHeadingText = replyElement ? replyElement.firstChild.textContent : '';
		if ( temporaryElement ) {
			// The element already exists, no need to recreate.
			return;
		}

		temporaryElement = document.createElement( 'div' );
		temporaryElement.classList.add( config.temporaryFormClass );
		temporaryElement.style.display = 'none';
		temporaryElement.textContent   = initialHeadingText;
		respondElement.parentNode.insertBefore( temporaryElement, respondElement );
	}

	return {
		init: init,
		moveForm: moveForm
	};
})( window );

/* jshint ignore:end */
