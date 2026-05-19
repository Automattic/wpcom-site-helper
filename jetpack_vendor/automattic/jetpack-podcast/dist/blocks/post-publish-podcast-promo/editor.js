/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/editor/post-publish-podcast-promo/style.scss"
/*!**********************************************************!*\
  !*** ./src/editor/post-publish-podcast-promo/style.scss ***!
  \**********************************************************/
(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ },

/***/ "react/jsx-runtime"
/*!**********************************!*\
  !*** external "ReactJSXRuntime" ***!
  \**********************************/
(module) {

module.exports = window["ReactJSXRuntime"];

/***/ },

/***/ "@wordpress/api-fetch"
/*!**********************************!*\
  !*** external ["wp","apiFetch"] ***!
  \**********************************/
(module) {

module.exports = window["wp"]["apiFetch"];

/***/ },

/***/ "@wordpress/components"
/*!************************************!*\
  !*** external ["wp","components"] ***!
  \************************************/
(module) {

module.exports = window["wp"]["components"];

/***/ },

/***/ "@wordpress/compose"
/*!*********************************!*\
  !*** external ["wp","compose"] ***!
  \*********************************/
(module) {

module.exports = window["wp"]["compose"];

/***/ },

/***/ "@wordpress/data"
/*!******************************!*\
  !*** external ["wp","data"] ***!
  \******************************/
(module) {

module.exports = window["wp"]["data"];

/***/ },

/***/ "@wordpress/editor"
/*!********************************!*\
  !*** external ["wp","editor"] ***!
  \********************************/
(module) {

module.exports = window["wp"]["editor"];

/***/ },

/***/ "@wordpress/element"
/*!*********************************!*\
  !*** external ["wp","element"] ***!
  \*********************************/
(module) {

module.exports = window["wp"]["element"];

/***/ },

/***/ "@wordpress/i18n"
/*!******************************!*\
  !*** external ["wp","i18n"] ***!
  \******************************/
(module) {

module.exports = window["wp"]["i18n"];

/***/ },

/***/ "@wordpress/plugins"
/*!*********************************!*\
  !*** external ["wp","plugins"] ***!
  \*********************************/
(module) {

module.exports = window["wp"]["plugins"];

/***/ }

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Check if module exists (development only)
/******/ 		if (__webpack_modules__[moduleId] === undefined) {
/******/ 			var e = new Error("Cannot find module '" + moduleId + "'");
/******/ 			e.code = 'MODULE_NOT_FOUND';
/******/ 			throw e;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry needs to be wrapped in an IIFE because it needs to be isolated against other modules in the chunk.
(() => {
/*!*********************************************************!*\
  !*** ./src/editor/post-publish-podcast-promo/index.tsx ***!
  \*********************************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/api-fetch */ "@wordpress/api-fetch");
/* harmony import */ var _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_compose__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/compose */ "@wordpress/compose");
/* harmony import */ var _wordpress_compose__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_compose__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/data */ "@wordpress/data");
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_data__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _wordpress_editor__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @wordpress/editor */ "@wordpress/editor");
/* harmony import */ var _wordpress_editor__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_wordpress_editor__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_6__);
/* harmony import */ var _wordpress_plugins__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! @wordpress/plugins */ "@wordpress/plugins");
/* harmony import */ var _wordpress_plugins__WEBPACK_IMPORTED_MODULE_7___default = /*#__PURE__*/__webpack_require__.n(_wordpress_plugins__WEBPACK_IMPORTED_MODULE_7__);
/* harmony import */ var _style_scss__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ./style.scss */ "./src/editor/post-publish-podcast-promo/style.scss");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! react/jsx-runtime */ "react/jsx-runtime");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_9___default = /*#__PURE__*/__webpack_require__.n(react_jsx_runtime__WEBPACK_IMPORTED_MODULE_9__);







const __ = _wordpress_i18n__WEBPACK_IMPORTED_MODULE_6__.__;



const getPromoData = () => window.jetpackPostPublishPodcastPromo;

// The editor can emit an immediate request-close from the publish click/focus transition.
const requestCloseGracePeriod = 1000;
const PostPublishPodcastPromo = () => {
  const data = getPromoData();
  const [isOpen, setIsOpen] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_5__.useState)(false);
  const [isClosedForSession, setIsClosedForSession] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_5__.useState)(false);
  const openedAt = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_5__.useRef)(0);
  const {
    isPostPublished,
    isPublishingPost,
    postType
  } = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_3__.useSelect)(select => {
    const editor = select(_wordpress_editor__WEBPACK_IMPORTED_MODULE_4__.store);
    return {
      isPostPublished: editor.isCurrentPostPublished(),
      isPublishingPost: editor.isPublishingPost(),
      postType: editor.getCurrentPostType()
    };
  }, []);
  const wasPublishingPost = (0,_wordpress_compose__WEBPACK_IMPORTED_MODULE_2__.usePrevious)(isPublishingPost);
  const wasPostPublished = (0,_wordpress_compose__WEBPACK_IMPORTED_MODULE_2__.usePrevious)(isPostPublished);
  (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_5__.useEffect)(() => {
    if (!data || isClosedForSession) {
      return;
    }
    if (postType === 'post' && wasPublishingPost && !isPublishingPost && !wasPostPublished && isPostPublished) {
      window.setTimeout(() => {
        openedAt.current = Date.now();
        setIsOpen(true);
      });
    }
  }, [data, isClosedForSession, isPostPublished, isPublishingPost, postType, wasPostPublished, wasPublishingPost]);
  const closeModal = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_5__.useCallback)((force = false) => {
    if (!force && Date.now() - openedAt.current < requestCloseGracePeriod) {
      return;
    }
    if (data) {
      _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_0___default()({
        path: data.dismissPath,
        method: 'POST'
      }).catch(() => {});
    }
    setIsClosedForSession(true);
    setIsOpen(false);
  }, [data]);
  const handleRequestClose = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_5__.useCallback)(() => closeModal(), [closeModal]);
  const goToCreatePodcast = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_5__.useCallback)(() => {
    if (!data) {
      return;
    }
    _wordpress_api_fetch__WEBPACK_IMPORTED_MODULE_0___default()({
      path: data.dismissPath,
      method: 'POST'
    }).catch(() => {}).finally(() => {
      (window.top || window).location.href = data.createUrl;
    });
  }, [data]);
  if (!data || !isOpen) {
    return null;
  }
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_9__.jsxs)(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__.Modal, {
    className: "jetpack-post-publish-podcast-promo-modal",
    title: "",
    aria: {
      labelledby: 'jetpack-post-publish-podcast-promo-modal-title'
    },
    onRequestClose: handleRequestClose,
    children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_9__.jsxs)("div", {
      className: "jetpack-post-publish-podcast-promo-modal__hero",
      children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_9__.jsxs)("svg", {
        className: "jetpack-post-publish-podcast-promo-modal__soundwave",
        viewBox: "0 0 320 96",
        preserveAspectRatio: "none",
        "aria-hidden": "true",
        focusable: "false",
        xmlns: "http://www.w3.org/2000/svg",
        children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_9__.jsx)("rect", {
          x: "8",
          y: "34",
          width: "5",
          height: "28",
          rx: "2.5"
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_9__.jsx)("rect", {
          x: "24",
          y: "26",
          width: "5",
          height: "44",
          rx: "2.5"
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_9__.jsx)("rect", {
          x: "40",
          y: "16",
          width: "5",
          height: "64",
          rx: "2.5"
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_9__.jsx)("rect", {
          x: "56",
          y: "30",
          width: "5",
          height: "36",
          rx: "2.5"
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_9__.jsx)("rect", {
          x: "72",
          y: "24",
          width: "5",
          height: "48",
          rx: "2.5"
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_9__.jsx)("rect", {
          x: "88",
          y: "34",
          width: "5",
          height: "28",
          rx: "2.5"
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_9__.jsx)("rect", {
          x: "104",
          y: "26",
          width: "5",
          height: "44",
          rx: "2.5"
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_9__.jsx)("rect", {
          x: "120",
          y: "30",
          width: "5",
          height: "36",
          rx: "2.5"
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_9__.jsx)("rect", {
          x: "136",
          y: "40",
          width: "5",
          height: "16",
          rx: "2.5"
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_9__.jsx)("rect", {
          x: "179",
          y: "40",
          width: "5",
          height: "16",
          rx: "2.5"
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_9__.jsx)("rect", {
          x: "195",
          y: "30",
          width: "5",
          height: "36",
          rx: "2.5"
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_9__.jsx)("rect", {
          x: "211",
          y: "26",
          width: "5",
          height: "44",
          rx: "2.5"
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_9__.jsx)("rect", {
          x: "227",
          y: "34",
          width: "5",
          height: "28",
          rx: "2.5"
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_9__.jsx)("rect", {
          x: "243",
          y: "24",
          width: "5",
          height: "48",
          rx: "2.5"
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_9__.jsx)("rect", {
          x: "259",
          y: "30",
          width: "5",
          height: "36",
          rx: "2.5"
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_9__.jsx)("rect", {
          x: "275",
          y: "16",
          width: "5",
          height: "64",
          rx: "2.5"
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_9__.jsx)("rect", {
          x: "291",
          y: "26",
          width: "5",
          height: "44",
          rx: "2.5"
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_9__.jsx)("rect", {
          x: "307",
          y: "34",
          width: "5",
          height: "28",
          rx: "2.5"
        })]
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_9__.jsx)("div", {
        className: "jetpack-post-publish-podcast-promo-modal__hero-art",
        "aria-hidden": "true",
        children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_9__.jsxs)("svg", {
          viewBox: "0 0 64 64",
          width: "88",
          height: "88",
          xmlns: "http://www.w3.org/2000/svg",
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_9__.jsx)("defs", {
            children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_9__.jsxs)("linearGradient", {
              id: "jetpack-post-publish-podcast-promo-grad",
              x1: "0",
              y1: "0",
              x2: "1",
              y2: "1",
              children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_9__.jsx)("stop", {
                offset: "0%",
                stopColor: "#ffffff",
                stopOpacity: "0.35"
              }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_9__.jsx)("stop", {
                offset: "100%",
                stopColor: "#ffffff",
                stopOpacity: "0"
              })]
            })
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_9__.jsx)("circle", {
            cx: "32",
            cy: "32",
            r: "28",
            fill: "url(#jetpack-post-publish-podcast-promo-grad)"
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_9__.jsx)("path", {
            fill: "#fff",
            d: "M32 14a8 8 0 0 0-8 8v10a8 8 0 0 0 16 0V22a8 8 0 0 0-8-8zm-12 18a1.5 1.5 0 0 1 3 0 9 9 0 0 0 18 0 1.5 1.5 0 0 1 3 0 12 12 0 0 1-10.5 11.9V48h4.5v3h-12v-3H30v-2.1A12 12 0 0 1 20 32z"
          })]
        })
      })]
    }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_9__.jsxs)("div", {
      className: "jetpack-post-publish-podcast-promo-modal__body",
      children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_9__.jsx)("h1", {
        id: "jetpack-post-publish-podcast-promo-modal-title",
        className: "jetpack-post-publish-podcast-promo-modal__title",
        children: __('Your post is live. Ready for the podcast version?', "jetpack-podcast")
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_9__.jsx)("p", {
        className: "jetpack-post-publish-podcast-promo-modal__description",
        children: __('Give your audience another way to enjoy your content. Pick a date range or a few posts, and we’ll turn them into a two-host podcast episode.', "jetpack-podcast")
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_9__.jsx)("div", {
        className: "jetpack-post-publish-podcast-promo-modal__actions",
        children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_9__.jsx)(_wordpress_components__WEBPACK_IMPORTED_MODULE_1__.Button, {
          className: "jetpack-post-publish-podcast-promo-modal__primary-action",
          variant: "primary",
          onClick: goToCreatePodcast,
          children: __('Create podcast episode', "jetpack-podcast")
        })
      })]
    })]
  });
};
if (!(0,_wordpress_plugins__WEBPACK_IMPORTED_MODULE_7__.getPlugin)('jetpack-post-publish-podcast-promo')) {
  (0,_wordpress_plugins__WEBPACK_IMPORTED_MODULE_7__.registerPlugin)('jetpack-post-publish-podcast-promo', {
    render: PostPublishPodcastPromo
  });
}
})();

/******/ })()
;
//# sourceMappingURL=editor.js.map