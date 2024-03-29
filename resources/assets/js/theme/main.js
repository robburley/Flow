//
// Main javascript
// 
//
// Initialize & Configure plugins


//
// Table of content:
//
// 1. Sidebar
// 2. Switches
// 3. Toggles
// 4. Todo Tasks
// 5. Chat Dialogue
// 6. Boards (dragula plugin)
// 7. Select (select2 plugin)
// 8. File Upload (dropzone plugin)
// 9. Sortable Table (dataTable plugin)
// 10. Date Picker (datepicker plugin)
// 11. Map (jqvmap plugin)

'use strict'

//
// Note: Bootstrap plugins is enabled via data attributes
//

// A fix to initialise dropzone on document ready
Dropzone.autoDiscover = false


$(function () {
    // Initialize 

    Sidebar() // 1. Sidebar

    // 7. Select
    if ($('.c-select').length) {
        var $singleSelect = $('.c-select'),
            $singleSelectHasSearch = $('.c-select.has-search'),
            $multipleSelect = $('.c-select.c-select--multiple'),
            $disabledSelect = $('.c-select.is-disabled')

        $singleSelect.select2({
            width: '100%',
            minimumResultsForSearch: Infinity, // disable search
        })

        // single select with search enabled
        $singleSelectHasSearch.select2({
            width: '100%',
        })

        // multiple select
        $multipleSelect.select2({
            width: '100%',
            multiple: true,
        })

        // disabled select
        $disabledSelect.select2({
            width: '100%',
            disabled: true,
        })
    }


    // 10. datepicker
    if ($('[data-toggle="datepicker"]').length) {
        $('[data-toggle="datepicker"]').datepicker({
            format: 'dd/mm/yyyy',
        })
    }

    // 11. Custom Bootstrap Popovers
    $('[data-toggle=popover]').popover({
        trigger: 'focus',
        template: '<div class="c-popover popover">' +
        '<div class="c-popover__arrow popover-arrow"></div>' +
        '<div class="c-popover__body popover-body">' +
        '</div>' +
        '</div>',
    })

    // 12. Timepicker

    if ($('[data-toggle="timepicker"]').length) {
        $('[data-toggle="timepicker"]').timepicker()
    }
})
