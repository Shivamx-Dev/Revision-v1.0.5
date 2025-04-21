"use strict";

function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }
function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, _toPropertyKey(descriptor.key), descriptor); } }
function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }
function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function"); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, writable: true, configurable: true } }); Object.defineProperty(subClass, "prototype", { writable: false }); if (superClass) _setPrototypeOf(subClass, superClass); }
function _setPrototypeOf(o, p) { _setPrototypeOf = Object.setPrototypeOf ? Object.setPrototypeOf.bind() : function _setPrototypeOf(o, p) { o.__proto__ = p; return o; }; return _setPrototypeOf(o, p); }
function _createSuper(Derived) { var hasNativeReflectConstruct = _isNativeReflectConstruct(); return function _createSuperInternal() { var Super = _getPrototypeOf(Derived), result; if (hasNativeReflectConstruct) { var NewTarget = _getPrototypeOf(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return _possibleConstructorReturn(this, result); }; }
function _possibleConstructorReturn(self, call) { if (call && (_typeof(call) === "object" || typeof call === "function")) { return call; } else if (call !== void 0) { throw new TypeError("Derived constructors may only return object or undefined"); } return _assertThisInitialized(self); }
function _assertThisInitialized(self) { if (self === void 0) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return self; }
function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); return true; } catch (e) { return false; } }
function _getPrototypeOf(o) { _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf.bind() : function _getPrototypeOf(o) { return o.__proto__ || Object.getPrototypeOf(o); }; return _getPrototypeOf(o); }
function ownKeys(e, r) { var t = Object.keys(e); if (Object.getOwnPropertySymbols) { var o = Object.getOwnPropertySymbols(e); r && (o = o.filter(function (r) { return Object.getOwnPropertyDescriptor(e, r).enumerable; })), t.push.apply(t, o); } return t; }
function _objectSpread(e) { for (var r = 1; r < arguments.length; r++) { var t = null != arguments[r] ? arguments[r] : {}; r % 2 ? ownKeys(Object(t), !0).forEach(function (r) { _defineProperty(e, r, t[r]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(t)) : ownKeys(Object(t)).forEach(function (r) { Object.defineProperty(e, r, Object.getOwnPropertyDescriptor(t, r)); }); } return e; }
function _defineProperty(obj, key, value) { key = _toPropertyKey(key); if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }
function _toPropertyKey(arg) { var key = _toPrimitive(arg, "string"); return _typeof(key) === "symbol" ? key : String(key); }
function _toPrimitive(input, hint) { if (_typeof(input) !== "object" || input === null) return input; var prim = input[Symbol.toPrimitive]; if (prim !== undefined) { var res = prim.call(input, hint || "default"); if (_typeof(res) !== "object") return res; throw new TypeError("@@toPrimitive must return a primitive value."); } return (hint === "string" ? String : Number)(input); }
/**
 * Register Panel
 */

function csRegisterPanels() {
  var __ = wp.i18n.__;
  var compose = wp.compose.compose;
  var Component = wp.element.Component;
  var _wp$components = wp.components,
    SelectControl = _wp$components.SelectControl,
    CheckboxControl = _wp$components.CheckboxControl,
    ToggleControl = _wp$components.ToggleControl,
    TextControl = _wp$components.TextControl,
    RangeControl = _wp$components.RangeControl;
  var PluginDocumentSettingPanel = wp.editPost.PluginDocumentSettingPanel;
  var _wp$data = wp.data,
    withSelect = _wp$data.withSelect,
    withDispatch = _wp$data.withDispatch;
  var registerPlugin = wp.plugins.registerPlugin;

  // Fetch the post meta.
  var applyWithSelect = withSelect(function (select) {
    var _select = select('core/editor'),
      getEditedPostAttribute = _select.getEditedPostAttribute;
    return {
      meta: getEditedPostAttribute('meta')
    };
  });

  // Provide method to update post meta.
  var applyWithDispatch = withDispatch(function (dispatch, _ref) {
    var meta = _ref.meta;
    var _dispatch = dispatch('core/editor'),
      editPost = _dispatch.editPost;
    return {
      updateMeta: function updateMeta(newMeta) {
        editPost({
          meta: _objectSpread(_objectSpread({}, meta), newMeta)
        });
      }
    };
  });

  /**
   * ==================================
   * Layout Options
   * ==================================
   */
  if ('post' === csPanelsData.postType || 'page' === csPanelsData.postType) {
    var csThemeLayoutOptions = /*#__PURE__*/function (_Component) {
      _inherits(csThemeLayoutOptions, _Component);
      var _super = _createSuper(csThemeLayoutOptions);
      function csThemeLayoutOptions() {
        _classCallCheck(this, csThemeLayoutOptions);
        return _super.apply(this, arguments);
      }
      _createClass(csThemeLayoutOptions, [{
        key: "render",
        value: function render() {
          var _this$props = this.props,
            _this$props$meta = _this$props.meta,
            _this$props$meta2 = _this$props$meta === void 0 ? {} : _this$props$meta,
            csco_singular_sidebar = _this$props$meta2.csco_singular_sidebar,
            csco_page_header_type = _this$props$meta2.csco_page_header_type,
            csco_page_load_nextpost = _this$props$meta2.csco_page_load_nextpost,
            updateMeta = _this$props.updateMeta;
          return /*#__PURE__*/React.createElement(PluginDocumentSettingPanel, {
            title: __('Layout Options', 'revision')
          }, /*#__PURE__*/React.createElement(SelectControl, {
            label: __('Sidebar', 'revision'),
            value: csco_singular_sidebar,
            onChange: function onChange(value) {
              updateMeta({
                csco_singular_sidebar: value || 'default'
              });
            },
            options: csPanelsData.singularSidebar
          }), /*#__PURE__*/React.createElement(SelectControl, {
            label: __('Page Header Type', 'revision'),
            value: csco_page_header_type,
            onChange: function onChange(value) {
              updateMeta({
                csco_page_header_type: value || 'default'
              });
            },
            options: csPanelsData.pageHeaderType
          }), /*#__PURE__*/React.createElement(SelectControl, {
            label: __('Auto Load Next Post', 'revision'),
            value: csco_page_load_nextpost,
            onChange: function onChange(value) {
              updateMeta({
                csco_page_load_nextpost: value || 'default'
              });
            },
            options: csPanelsData.pageLoadNextpost
          }));
        }
      }]);
      return csThemeLayoutOptions;
    }(Component); // Combine the higher-order components.
    var render = compose([applyWithSelect, applyWithDispatch])(csThemeLayoutOptions);

    // Register panel.
    registerPlugin('cs-theme-layout-options', {
      icon: false,
      render: render
    });
  }
}
csRegisterPanels();