(function() {
	document.addEventListener('DOMContentLoaded', function() {
		var dataTimestamp = cscoPromoBannerConfig.data_timestamp;
		var now = Math.floor(Date.now() / 1000);
		var updateInterval = cscoPromoBannerConfig.update_interval;

		// Check if data needs to be updated.
		if (now - dataTimestamp > updateInterval) {
			// Fetch banners data from external JSON URL.
			fetch(cscoPromoBannerConfig.json_url)
				.then(function(response) {
					if (!response.ok) {
						throw new Error('Network response was not ok');
					}
					return response.text();
				})
				.then(function(data) {
					// Send data to server via AJAX.
					fetch(cscoPromoBannerConfig.ajax_url, {
						method: 'POST',
						credentials: 'same-origin',
						headers: {
							'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
						},
						body: 'action=save_promo_banners_data&nonce=' + encodeURIComponent(cscoPromoBannerConfig.nonce) + '&banners_data=' + encodeURIComponent(data)
					})
					.then(function(response) {
						if (!response.ok) {
							throw new Error('Network response was not ok');
						}
						return response.json();
					})
					.then(function(result) {
						if (!result.success) {
							console.error('Failed to save promo banners data:', result.data);
						}
					})
					.catch(function(error) {
						console.error('Error saving promo banners data:', error);
					});
				})
				.catch(function(error) {
					console.error('Error fetching promo banners data:', error);
				});
		}

		// Handle dismiss action.
		document.addEventListener('click', function(event) {
			if (event.target.classList.contains('notice-dismiss')) {
				var notice = event.target.closest('.cs-promo-banner');
				if (notice && notice.dataset.bannerId) {
					var bannerId = notice.dataset.bannerId;

					// Send AJAX request to dismiss the banner.
					fetch(cscoPromoBannerConfig.ajax_url, {
						method: 'POST',
						credentials: 'same-origin',
						headers: {
							'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
						},
						body: 'action=dismiss_promo_banner&nonce=' + encodeURIComponent(cscoPromoBannerConfig.nonce) + '&banner_id=' + encodeURIComponent(bannerId)
					})
					.then(function(response) {
						if (!response.ok) {
							throw new Error('Network response was not ok');
						}
						return response.json();
					})
					.then(function(result) {
						if (!result.success) {
							console.error('Failed to dismiss banner:', result.data);
						}
					})
					.catch(function(error) {
						console.error('Error dismissing banner:', error);
					});
				}
			}
		});
	});
})();
