"use strict";
function getHtml() {
    return '<tr>\n' +
        '                                        <td>\n' +
        '                                            <div class="d-flex px-2 py-1">\n' +
        '                                                <input type="text" name="value">\n' +
        '                                            </div>\n' +
        '                                        </td>\n' +
        '                                        <td>\n' +
        '                                            <div class="d-flex px-2 py-1">\n' +
        '                                                <input type="text" name="watch">\n' +
        '                                            </div>\n' +
        '                                        </td>\n' +
        '                                    </tr>';
}

$('.add-option').onclick(function () {
    $('attribute-value').append('<tr>\n' +
        '                                        <td>\n' +
        '                                            <div class="d-flex px-2 py-1">\n' +
        '                                                <input type="text" name="value0">\n' +
        '                                            </div>\n' +
        '                                        </td>\n' +
        '                                        <td>\n' +
        '                                            <div class="d-flex px-2 py-1">\n' +
        '                                                <input type="text" name="watch0">\n' +
        '                                            </div>\n' +
        '                                        </td>\n' +
        '                                        <td>\n' +
        '                                            <div class="d-flex px-2 py-1">\n' +
        '                                                <button type="button" class="btn btn-secondary">Delete</button>\n' +
        '                                            </div>\n' +
        '                                        </td>\n' +
        '                                    </tr>');
})
