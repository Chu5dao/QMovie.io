/*
 * ATTENTION: An "eval-source-map" devtool has been used.
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file with attached SourceMaps in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/userStatus.js":
/*!************************************!*\
  !*** ./resources/js/userStatus.js ***!
  \************************************/
/***/ (() => {

eval("document.addEventListener('DOMContentLoaded', function () {\n  // Đoạn mã xử lý cho 'online-users-count'\n  var onlineUsersCountElement = document.getElementById('online-users-count');\n  if (!onlineUsersCountElement) {\n    console.error('Element with ID \"online-users-count\" not found.');\n  } else {\n    // Lắng nghe sự kiện OnlineUsersUpdated từ Laravel Echo\n    window.Echo.channel('online-users').listen('.OnlineUsersUpdated', function (e) {\n      onlineUsersCountElement.innerText = \"T\\xE0i kho\\u1EA3n: \".concat(e.count);\n    });\n  }\n\n  // Đoạn mã xử lý cho 'page-views-count'\n  var pageViewsCountElement = document.getElementById('page-views-count');\n  if (!pageViewsCountElement) {\n    console.error('Element with ID \"page-views-count\" not found.');\n  } else {\n    window.Echo.channel('page-views-count').listen('.UpdatePageViews', function (e) {\n      pageViewsCountElement.innerText = 'Lượt truy cập: ' + e.count;\n    });\n  }\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJuYW1lcyI6WyJkb2N1bWVudCIsImFkZEV2ZW50TGlzdGVuZXIiLCJvbmxpbmVVc2Vyc0NvdW50RWxlbWVudCIsImdldEVsZW1lbnRCeUlkIiwiY29uc29sZSIsImVycm9yIiwid2luZG93IiwiRWNobyIsImNoYW5uZWwiLCJsaXN0ZW4iLCJlIiwiaW5uZXJUZXh0IiwiY29uY2F0IiwiY291bnQiLCJwYWdlVmlld3NDb3VudEVsZW1lbnQiXSwic291cmNlcyI6WyJ3ZWJwYWNrOi8vLy4vcmVzb3VyY2VzL2pzL3VzZXJTdGF0dXMuanM/MWVhMSJdLCJzb3VyY2VzQ29udGVudCI6WyJkb2N1bWVudC5hZGRFdmVudExpc3RlbmVyKCdET01Db250ZW50TG9hZGVkJywgKCkgPT4ge1xyXG4gICAgLy8gxJBv4bqhbiBtw6MgeOG7rSBsw70gY2hvICdvbmxpbmUtdXNlcnMtY291bnQnXHJcbiAgICBjb25zdCBvbmxpbmVVc2Vyc0NvdW50RWxlbWVudCA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdvbmxpbmUtdXNlcnMtY291bnQnKTtcclxuICAgIGlmICghb25saW5lVXNlcnNDb3VudEVsZW1lbnQpIHtcclxuICAgICAgICBjb25zb2xlLmVycm9yKCdFbGVtZW50IHdpdGggSUQgXCJvbmxpbmUtdXNlcnMtY291bnRcIiBub3QgZm91bmQuJyk7XHJcbiAgICB9IGVsc2Uge1xyXG4gICAgICAgIC8vIEzhuq9uZyBuZ2hlIHPhu7Ega2nhu4duIE9ubGluZVVzZXJzVXBkYXRlZCB04burIExhcmF2ZWwgRWNob1xyXG4gICAgICAgIHdpbmRvdy5FY2hvLmNoYW5uZWwoJ29ubGluZS11c2VycycpXHJcbiAgICAgICAgICAgIC5saXN0ZW4oJy5PbmxpbmVVc2Vyc1VwZGF0ZWQnLCAoZSkgPT4ge1xyXG4gICAgICAgICAgICAgICAgb25saW5lVXNlcnNDb3VudEVsZW1lbnQuaW5uZXJUZXh0ID0gYFTDoGkga2hv4bqjbjogJHtlLmNvdW50fWA7XHJcbiAgICAgICAgICAgIH0pO1xyXG4gICAgfVxyXG5cclxuICAgIC8vIMSQb+G6oW4gbcOjIHjhu60gbMO9IGNobyAncGFnZS12aWV3cy1jb3VudCdcclxuICAgIGNvbnN0IHBhZ2VWaWV3c0NvdW50RWxlbWVudCA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdwYWdlLXZpZXdzLWNvdW50Jyk7XHJcbiAgICBpZiAoIXBhZ2VWaWV3c0NvdW50RWxlbWVudCkge1xyXG4gICAgICAgIGNvbnNvbGUuZXJyb3IoJ0VsZW1lbnQgd2l0aCBJRCBcInBhZ2Utdmlld3MtY291bnRcIiBub3QgZm91bmQuJyk7XHJcbiAgICB9IGVsc2Uge1xyXG4gICAgICAgIHdpbmRvdy5FY2hvLmNoYW5uZWwoJ3BhZ2Utdmlld3MtY291bnQnKVxyXG4gICAgICAgICAgICAubGlzdGVuKCcuVXBkYXRlUGFnZVZpZXdzJywgKGUpID0+IHtcclxuICAgICAgICAgICAgICAgIHBhZ2VWaWV3c0NvdW50RWxlbWVudC5pbm5lclRleHQgPSAnTMaw4bujdCB0cnV5IGPhuq1wOiAnICsgZS5jb3VudDtcclxuICAgICAgICAgICAgfSk7XHJcbiAgICB9XHJcbn0pOyJdLCJtYXBwaW5ncyI6IkFBQUFBLFFBQVEsQ0FBQ0MsZ0JBQWdCLENBQUMsa0JBQWtCLEVBQUUsWUFBTTtFQUNoRDtFQUNBLElBQU1DLHVCQUF1QixHQUFHRixRQUFRLENBQUNHLGNBQWMsQ0FBQyxvQkFBb0IsQ0FBQztFQUM3RSxJQUFJLENBQUNELHVCQUF1QixFQUFFO0lBQzFCRSxPQUFPLENBQUNDLEtBQUssQ0FBQyxpREFBaUQsQ0FBQztFQUNwRSxDQUFDLE1BQU07SUFDSDtJQUNBQyxNQUFNLENBQUNDLElBQUksQ0FBQ0MsT0FBTyxDQUFDLGNBQWMsQ0FBQyxDQUM5QkMsTUFBTSxDQUFDLHFCQUFxQixFQUFFLFVBQUNDLENBQUMsRUFBSztNQUNsQ1IsdUJBQXVCLENBQUNTLFNBQVMseUJBQUFDLE1BQUEsQ0FBaUJGLENBQUMsQ0FBQ0csS0FBSyxDQUFFO0lBQy9ELENBQUMsQ0FBQztFQUNWOztFQUVBO0VBQ0EsSUFBTUMscUJBQXFCLEdBQUdkLFFBQVEsQ0FBQ0csY0FBYyxDQUFDLGtCQUFrQixDQUFDO0VBQ3pFLElBQUksQ0FBQ1cscUJBQXFCLEVBQUU7SUFDeEJWLE9BQU8sQ0FBQ0MsS0FBSyxDQUFDLCtDQUErQyxDQUFDO0VBQ2xFLENBQUMsTUFBTTtJQUNIQyxNQUFNLENBQUNDLElBQUksQ0FBQ0MsT0FBTyxDQUFDLGtCQUFrQixDQUFDLENBQ2xDQyxNQUFNLENBQUMsa0JBQWtCLEVBQUUsVUFBQ0MsQ0FBQyxFQUFLO01BQy9CSSxxQkFBcUIsQ0FBQ0gsU0FBUyxHQUFHLGlCQUFpQixHQUFHRCxDQUFDLENBQUNHLEtBQUs7SUFDakUsQ0FBQyxDQUFDO0VBQ1Y7QUFDSixDQUFDLENBQUMiLCJpZ25vcmVMaXN0IjpbXSwiZmlsZSI6Ii4vcmVzb3VyY2VzL2pzL3VzZXJTdGF0dXMuanMiLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./resources/js/userStatus.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/js/userStatus.js"]();
/******/ 	
/******/ })()
;