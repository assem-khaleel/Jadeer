var period = {
    SelectionMode: 'Year',
    BeforeSelectedYear: 5,
    AfterSelectedYear: 7,
    SelectedYear: (new Date()).getFullYear(),
    SelectedMonth: (new Date()).getMonth(),
    SelectedQuarter: Math.floor((new Date()).getMonth() / 3),
    MonthNames: new Array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"),
    MonthAbbreviations: new Array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"),
    Quarters: new Array("Q1", "Q2", "Q3", "Q4"),
    CurrentClick: function (day) {
        if (this.SelectionMode == 'Year') {
            this.SelectedYear = parseInt(day.attr('data-var'));
            this.LabelControl.html(this.SelectedYear);
        }
        if (this.SelectionMode == 'Month') {
            this.SelectedMonth = this.MonthNames.indexOf(day.attr('data-var'));
            this.LabelControl.html(this.MonthNames[this.SelectedMonth] + ' ' + this.SelectedYear);
        }
        if (this.SelectionMode == 'Quarter') {
            this.SelectedQuarter = this.Quarters.indexOf(day.attr('data-var'));
            this.LabelControl.html(this.Quarters[this.SelectedQuarter] + ' ' + this.SelectedYear);
        }
        $("td.day").removeClass('active');
        day.addClass('active');

        this.afterClick();
    },
    LeftClick: function () {
        if (period.SelectionMode == 'Year') {
            period.SelectedYear -= 1;
        }
        if (period.SelectionMode == 'Month') {
            if (period.SelectedMonth == 0) {
                period.SelectedMonth = 11;
                period.SelectedYear -= 1;
            }
            else {
                period.SelectedMonth -= 1;
            }
        }
        if (period.SelectionMode == 'Quarter') {
            if (period.SelectedQuarter == 0) {
                period.SelectedQuarter = 3;
                period.SelectedYear -= 1;
            }
            else {
                period.SelectedQuarter -= 1;
            }
        }
        period.show();
        period.afterClick();
    },
    RightClick: function () {
        if (period.SelectionMode == 'Year') {
            period.SelectedYear += 1;
        }
        if (period.SelectionMode == 'Month') {
            if (period.SelectedMonth == 11) {
                period.SelectedMonth = 0;
                period.SelectedYear += 1;
            }
            else {
                period.SelectedMonth += 1;
            }
        }
        if (period.SelectionMode == 'Quarter') {
            if (period.SelectedQuarter == 3) {
                period.SelectedQuarter = 0;
                period.SelectedYear += 1;
            }
            else {
                period.SelectedQuarter += 1;
            }
        }
        period.show();
        period.afterClick();
    },
    init: function (options) {

        var obj = this;

        obj.FilterMode = options.FilterControl;
        obj.LeftNavControl = options.PrevBtn;
        obj.RightNavControl = options.NextBtn;
        obj.LabelControl = options.LabelControl;
        obj.RenderControl = options.Selector;

        obj.LeftNavControl.bind('click', obj.LeftClick);
        obj.RightNavControl.bind('click', obj.RightClick);
        obj.afterClick = options.AfterClick;
        obj.show();

        obj.FilterMode.change(function () {
            obj.SelectionMode = $(this).val();
            obj.show();
        });

        $(document).on("click", "td.day", function() {
            obj.CurrentClick($(this));
        });
    },
    afterClick : function () {

    },
    getMode : function () {
        return this.SelectionMode;
    },
    getSelectionYear : function () {
        return parseInt(this.SelectedYear);
    },
    getSelectionValue : function () {
        switch (this.SelectionMode) {
            case 'Year':
                return parseInt(this.SelectedYear);
                break;
            case 'Month':
                return parseInt(this.SelectedMonth) + 1;
                break;
            case 'Quarter':
                return parseInt(this.SelectedQuarter) + 1;
                break;
        }
    },
    show: function () {
        var counter = 0;
        var selected = '';
        var out = '<tr>';
        this.RenderControl.html('');
        if (this.SelectionMode == 'Year') {
            for (i = (this.SelectedYear - 4); i < (this.SelectedYear + 8); i++) {
                if (this.SelectedYear == i) {
                    selected = ' active';
                }
                if (counter == 3) {
                    out += '</tr><tr>';
                    counter = 0;
                }
                var colspan = '';
                if (counter == 1) {
                    var colspan = ' colspan="2"';
                }
                out += '<td class="day'+ selected +'" data-var="' + i + '"' + colspan + '>' + i + '</td>';
                counter++;
            }
            this.RenderControl.html(out + '</tr>');
            this.LabelControl.html(this.SelectedYear);

            $("td.day").removeClass('active');
            $("td.day[data-var='"+ this.SelectedYear +"']").addClass('active');
        }
        if (this.SelectionMode == 'Month') {
            for (i = 0; i < this.MonthAbbreviations.length; i++) {
                if (this.SelectedMonth == this.MonthNames[i]) {
                    selected = ' active';
                }
                if (counter == 3) {
                    out += '</tr><tr>';
                    counter = 0;
                }
                var colspan = '';
                if (counter == 1) {
                    var colspan = ' colspan="2"';
                }
                out += '<td class="day'+ selected + '" data-var="' + this.MonthNames[i] + '"' + colspan + '>' + this.MonthAbbreviations[i] + '</td>';
                counter++;
            }
            this.RenderControl.html(out + '</tr>');
            this.LabelControl.html(this.MonthNames[this.SelectedMonth] + ' ' + this.SelectedYear);

            $("td.day").removeClass('active');
            $("td.day[data-var='"+ this.MonthNames[this.SelectedMonth] +"']").addClass('active');
        }
        if (this.SelectionMode == 'Quarter') {
            for (i = 0; i < this.Quarters.length; i++) {
                if (this.SelectedQuarter == this.Quarters[i]) {
                    selected = ' selected';
                }
                if (counter == 2) {
                    out += '</tr><tr>';
                    counter = 0;
                }
                out += '<td class="day' + selected + '" data-var="' + this.Quarters[i] + '" colspan="2">' + this.Quarters[i] + '</td>';
                counter++;
            }
            this.RenderControl.html(out + '</tr>');
            this.LabelControl.html(this.Quarters[this.SelectedQuarter] + ' ' + this.SelectedYear);

            $("td.day").removeClass('active');
            $("td.day[data-var='"+ this.Quarters[this.SelectedQuarter] +"']").addClass('active');
        }
    }
}