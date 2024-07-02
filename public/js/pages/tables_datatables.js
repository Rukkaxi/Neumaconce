/*
 * ATTENTION: An "eval-source-map" devtool has been used.
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file with attached SourceMaps in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
(() => { // webpackBootstrap
  var __webpack_modules__ = {

      /***/ "./resources/js/pages/tables_datatables.js":
      /*!*************************************************!*\
        !*** ./resources/js/pages/tables_datatables.js ***!
        \*************************************************/
          /***/ (() => {

              function _typeof(o) {
                  "@babel/helpers - typeof";
                  return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o);
              }
              function _classCallCheck(instance, Constructor) {
                  if (!(instance instanceof Constructor)) {
                      throw new TypeError("Cannot call a class as a function");
                  }
              }
              function _defineProperties(target, props) {
                  for (var i = 0; i < props.length; i++) {
                      var descriptor = props[i];
                      descriptor.enumerable = descriptor.enumerable || false;
                      descriptor.configurable = true;
                      if ("value" in descriptor) descriptor.writable = true;
                      Object.defineProperty(target, _toPropertyKey(descriptor.key), descriptor);
                  }
              }
              function _createClass(Constructor, protoProps, staticProps) {
                  if (protoProps) _defineProperties(Constructor.prototype, protoProps);
                  if (staticProps) _defineProperties(Constructor, staticProps);
                  Object.defineProperty(Constructor, "prototype", { writable: false });
                  return Constructor;
              }
              function _toPropertyKey(t) {
                  var i = _toPrimitive(t, "string");
                  return "symbol" == _typeof(i) ? i : i + "";
              }
              function _toPrimitive(t, r) {
                  if ("object" != _typeof(t) || !t) return t;
                  var e = t[Symbol.toPrimitive];
                  if (void 0 !== e) {
                      var i = e.call(t, r || "default");
                      if ("object" != _typeof(i)) return i;
                      throw new TypeError("@@toPrimitive must return a primitive value.");
                  }
                  return ("string" === r ? String : Number)(t);
              }

              /*
               *  Document   : tables_datatables.js
               *  Author     : cocos
               *  Description: Custom JS code used in Plugin Init Example Page
               */
              // DataTables, for more examples you can check out https://www.datatables.net/
              var pageTablesDatatables = /*#__PURE__*/function () {
                  function pageTablesDatatables() {
                      _classCallCheck(this, pageTablesDatatables);
                  }

                  return _createClass(pageTablesDatatables, null, [{
                      key: "initDataTables",
                      value:
                          /*
                           * Init DataTables functionality
                           *
                           */
                          function initDataTables() {
                              // Override a few default classes
                              jQuery.extend(jQuery.fn.dataTable.ext.classes, {
                                  sWrapper: "dataTables_wrapper dt-bootstrap5",
                                  sFilterInput: "form-control",
                                  sLengthSelect: "form-select"
                              });

                              // Override a few defaults
                              jQuery.extend(true, jQuery.fn.dataTable.defaults, {
                                  language: {
                                      lengthMenu: "_MENU_",
                                      search: "_INPUT_",
                                      searchPlaceholder: "Buscar...",
                                      info: "Página <strong>_PAGE_</strong> de <strong>_PAGES_</strong>",
                                      paginate: {
                                          first: '<i class="fa fa-angle-double-left"></i>',
                                          previous: '<i class="fa fa-angle-left"></i>',
                                          next: '<i class="fa fa-angle-right"></i>',
                                          last: '<i class="fa fa-angle-double-right"></i>'
                                      }
                                  }
                              });

                              // Override buttons default classes
                              jQuery.extend(true, jQuery.fn.DataTable.Buttons.defaults, {
                                  dom: {
                                      button: {
                                          className: 'btn btn-sm btn-primary'
                                      }
                                  }
                              });

                              // Init full DataTable
                              jQuery('.js-dataTable-full').DataTable({
                                  pageLength: 5,
                                  lengthMenu: [[5, 10, 20], [5, 10, 20]],
                                  autoWidth: false
                              });

                              // Init DataTable with Buttons
                              jQuery('.js-dataTable-buttons').DataTable({
                                  pageLength: 5,
                                  lengthMenu: [[5, 10, 20], [5, 10, 20]],
                                  autoWidth: false,
                                  buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                                  dom: "<'row'<'col-sm-12'<'text-center bg-body-light py-2 mb-2'B>>>" +
                                      "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                                      "<'row'<'col-sm-12'tr>>" +
                                      "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>"
                              });
                          }

                      /*
                       * Init functionality
                       *
                       */
                  }, {
                      key: "init",
                      value: function init() {
                          this.initDataTables();
                      }
                  }]);

                  return pageTablesDatatables;
              }();

              // Initialize when page loads
              Dashmix.onLoad(pageTablesDatatables.init());

              /***/
          })

  };
  /************************************************************************/

  // startup
  // Load entry module and return exports
  // This entry module can't be inlined because the eval-source-map devtool is used.
  var __webpack_exports__ = {};
  __webpack_modules__["./resources/js/pages/tables_datatables.js"]();

})();
