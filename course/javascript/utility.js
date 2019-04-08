// utility.js
// Whatever you want, you can find it here.


// Function: Currency Formatter
// Purpose: Adding dollar sign and thousand separator automatically
(function ($, undefined) {
    "use strict";
    // When ready.
    $(function () {
        let $form = $("#course_form");
        let $input = $form.find("#c_fundGoal");
        $input.on("keyup", function (event) {
            // When user select text in the document, also abort.
            let selection = window.getSelection().toString();
            if (selection !== '') {
                return;
            }
            // When the arrow keys are pressed, abort.
            if ($.inArray(event.keyCode, [38, 40, 37, 39]) !== -1) {
                return;
            }
            let $this = $(this);
            // Get the value.
            let input = $this.val();
            input = input.replace(/[\D\s\._\-]+/g, "");
            input = input ? parseInt(input, 10) : 0;
            $this.val(function () {
                return (input === 0) ? "" : input.toLocaleString("en-US");
            });
        });
        /**
         * ==================================
         * When Form Submitted
         * ==================================
         */
        $form.on("submit", function (event) {
            let $this = $(this);
            let arr = $this.serializeArray();
            for (let i = 0; i < arr.length; i++) {
                arr[i].value = arr[i].value.replace(/[($)\s\._\-]+/g, ''); // Sanitize the values.
            }
            ;
            // console.log(arr);
            event.preventDefault();
        });
    });
})(jQuery);

// Function: Get Today's Date
function getToday() {
    let today = new Date();
    let dd = today.getDate();
    let mm = today.getMonth() + 1; //January is 0!
    let yyyy = today.getFullYear();
    if (dd < 10) dd = '0' + dd;
    if (mm < 10) mm = '0' + mm;
    today = yyyy + '-' + mm + '-' + dd;
    return today;
    /*
    // 抓取今天的日期
    // another solution
    var today = new Date().toISOString();
    today = today.split('T')[0];
    console.log(document.getElementById("c_endDate")[0]);
    document.getElementById("c_endDate")[0].setAttribute('value', today);
    */
}

// Function: Thousand Separator Remover
// Purpose: Remove ',' in the value of money
function removeThousandSeparator(money_string) {
    money_string = money_string.split(',').join('');
    return money_string;
}

// Function: Form Input Format Checker
function formatChecker(inputId, checkFunction) {
    let inputValue = document.getElementById(inputId).value;
    let checkedValue = checkFunction(inputValue);
    document.getElementById(inputId).value = checkedValue;
}

// Function: Check Number
function checkNumber(inputValue) {
    let regEx = /[^0-9]/g;
    let checkedValue = inputValue.replace(regEx, "");
    return checkedValue;
}

// Function: Check Date Format
function checkDate(inputValue) {
    let regEx = /^([0-9]\d{3})-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/;
    let result = regEx.test(inputValue);
    return result;
}


// Function:
function InfoDisplay(inputId, hintId, checkFunction) {
    let inputValue = document.getElementById(inputId).value;
    let result = checkFunction(inputValue);
    if (result === true) {
        document.getElementById(hintId).innerHTML = '';
    } else {
        document.getElementById(hintId).innerHTML = '請輸入正確的日期格式: YYYY-MM-DD';
    }
}

/*
function InfoDisplay(inputId, checkFunction) {
    let inputValue = document.getElementById(inputId).value;
    let result = checkFunction(inputValue);
    if (result === true) {
        $('#' + inputId).notify("正確的日期格式!", "success");
    } else {
        $('#' + inputId).notify("請輸入正確的日期格式: YYYY-MM-DD", "warn");
    }
}
*/