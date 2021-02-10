function loadMoreProductsData(jQueryObjectLoadMore, jQueryObjectLoadMoreBtn, jQueryObjectProgress, url, numberOfPage, numberOfRows, search){
    var data = { "numberOfPage": numberOfPage, "numberOfRows": numberOfRows, "search": search };

    $.ajax({
        method: "GET",
        url: url,
        data: data,
        dataType: "json",
        success: function (result){
            if (result == null || result.length == 0 || result.length < 10){
                moreData = false;

                jQueryObjectLoadMoreBtn.html("Ne postoji vise podataka!");
                jQueryObjectLoadMoreBtn.prop('disabled', true);
            }

            if (result != null && result.length > 0)
            {
                $.each(result, function (index, item){
                    jQueryObjectLoadMore.append(
                        "<tr>" +
                        "<td class='text-center'>" + item.name + "</td>" +
                        "<td class='text-center'>" + item.unit + "</td>" +
                        "<td class='text-center'>" + item.price + "</td>" +
                        "<td class='text-center'>" + item.dateCreated + "</td>" +
                        "<td class='text-center'>" + yesOrNo(item.active) + "</td>" +
                        "<td class='text-center'>" +
                        "<a href='/productEdit?id="+ item.id +"' class='btn btn-primary'>Edit</a> &nbsp;" +
                        "<a href='/productDetails?id="+ item.id +"' class='btn btn-info'>Details</a> &nbsp;" +
                        "<a href='/productDelete?id="+ item.id +"' class='btn btn-danger'>Delete</a>" +
                        "</td>" +
                        "</tr>"
                    );
                });
            }
        },
        error: function (){
            alert("Greska prilikom ocitavanja podataka!");
        },
        beforeSend: function (){
            jQueryObjectProgress.show();
        },
        complete: function (){
            jQueryObjectProgress.hide();
        }
    });
}

function loadMoreCustomerData(jQueryObjectForAppend, jQueryObjectProgress, jQueryObjectLoadMoreBtn, url, numberOfPage, numberOfRows, search) {
    var data = { "numberOfPage": numberOfPage, "numberOfRows": numberOfRows, "search": search };

    $.ajax({
        method: "GET",
        url: url,
        data: data,
        dataType: "json",
        success: function (result){
            if (result == null || result.length == 0 || result.length < 10) {
                moreData = false;

                jQueryObjectLoadMoreBtn.html("Ne postoji vise podataka");
                jQueryObjectLoadMoreBtn.prop('disabled', true);
            }

            if (result != null && result.length > 0){
                $.each(result, function(i, item) {
                    jQueryObjectForAppend.append(
                        "<tr>" +
                        "<td class='text-center'>" + item.name + "</td>" +
                        "<td class='text-center'>" + item.email + "</td>" +
                        "<td class='text-center'>" + item.address + "</td>" +
                        "<td class='text-center'>" + item.number + "</td>" +
                        "<td class='text-center'>" +
                        "<a href='/customerEdit?id=" + item.id + "' class='btn btn-primary'>Edit</a> &nbsp;" +
                        "<a href='/customerDetails?id=" + item.id + "' class='btn btn-info'>Details</a> &nbsp;" +
                        "<a href='/customerDelete?id=" + item.id + "' class='btn btn-danger'>Delete</a>" +
                        "</td>" +
                        "</tr>"
                    );
                });
            }
        },
        error: function (){
            alert("Greska prilikom ocitavanja podataka!");
        },
        beforeSend: function () {
            jQueryObjectProgress.show();
        },
        complete: function () {
            jQueryObjectProgress.hide();
        },
    });
}

function loadMorePositionData(jQueryObjectForAppend, jQueryObjectProgress, jQueryObjectLoadMoreBtn, url, numberOfPage, numberOfRows, search) {
    var data = { "numberOfPage": numberOfPage, "numberOfRows": numberOfRows, "search": search };

    $.ajax({
        method: "GET",
        url: url,
        data: data,
        dataType: "json",
        success: function (result){
            if (result == null || result.length == 0 || result.length < 10) {
                moreData = false;

                jQueryObjectLoadMoreBtn.html("Ne postoji vise podataka");
                jQueryObjectLoadMoreBtn.prop('disabled', true);
            }

            if (result != null && result.length > 0){
                $.each(result, function(i, item) {
                    jQueryObjectForAppend.append(
                        "<tr>" +
                        "<td class='text-center'>" + item.email + "</td>" +
                        "<td class='text-center'>" + item.firstName + "</td>" +
                        "<td class='text-center'>" + item.lastName + "</td>" +
                        "<td class='text-center'>" + item.role + "</td>" +
                        "<td class='text-center'>" +
                        "<a href='/positionEdit?id=" + item.id + "' class='btn btn-primary'>EditUser</a> &nbsp;" +
                        "<a href='/positionEditRole?id=" + item.id + "' class='btn btn-primary'>EditRole</a> &nbsp;" +
                        "<a href='/positionDelete?id=" + item.id + "' class='btn btn-danger'>Delete</a>" +
                        "</td>" +
                        "</tr>"
                    );
                });
            }
        },
        error: function (){
            alert("Greska prilikom ocitavanja podataka!");
        },
        beforeSend: function () {
            jQueryObjectProgress.show();
        },
        complete: function () {
            jQueryObjectProgress.hide();
        },
    });
}

function loadMoreDataInvoices(jQueryObjectLoadMore, jQueryObjectLoadMoreBtn, jQueryObjectProgress, url, numberOfPage, numberOfRows, search){
    var data = { "numberOfPage": numberOfPage, "numberOfRows": numberOfRows, "search": search };

    $.ajax({
        method: "GET",
        url: url,
        data: data,
        dataType: "json",
        success: function (result){
            if (result == null || result.length == 0 || result.length < 10){

                jQueryObjectLoadMoreBtn.html("Ne postoji vise podataka!");
                jQueryObjectLoadMoreBtn.prop('disabled', true);
            }

            if (result != null && result.length > 0)
            {
                $.each(result, function (index, item){
                    jQueryObjectLoadMore.append(
                        "<tr>" +
                        "<td class='text-center'>" + item.id + "</td>" +
                        "<td class='text-center'>" + item.firstName + " " + item.lastName + "</td>" +
                        "<td class='text-center'>" + item.name + "</td>" +
                        "<td class='text-center'>" + item.dateCreated + "</td>" +
                        "<td class='text-center'>" + item.dateUpdated + "</td>" +
                        "<td class='text-center'>" + item.total + "</td>" +
                        "<td class='text-center'>" +
                        "<a href='/invoiceDetails?id="+ item.id +"' class='btn btn-info'>Details</a> &nbsp;" +
                        "</td>" +
                        "</tr>"
                    );
                });
            }
        },
        error: function (){
            alert("Greska prilikom ocitavanja podataka!");
        },
        beforeSend: function (){
            jQueryObjectProgress.show();
        },
        complete: function (){
            jQueryObjectProgress.hide();
        }
    });
}

//Replace name of inputs
function replaceName(jQueryObjectLoad, findClass) {
    var i = 0;

    jQueryObjectLoad.each(function (i, obj) {
        var inputs = $(obj).find('.' + findClass);
        // for each input change its name/id appending the num value
        $.each(inputs, function (index, elem) {
            var jElem = $(elem); // jQuery element
            var name = jElem.prop('name');
            // remove the number
            name = name.replace(/\d+/g, '');
            name = name.replace('[]', '[' + i + ']');
            jElem.prop('id', name);
            jElem.prop('data-select2-id', name);
            jElem.prop('name', name);
        });

        i++;
    });
}

//Reset all inputs in one object
function clear_form_elements(object_id) {
    $("#" + object_id).find(':input').each(function () {
        switch (this.type) {
            case 'password':
            case 'text':
            case 'textarea':
            case 'file':
            case 'select-one':
            case 'select-multiple':
            case 'date':
            case 'number':
            case 'tel':
            case 'email':
                $(this).val('');
                break;
            case 'checkbox':
            case 'radio':
                this.checked = false;
                break;
        }
    });
}

function yesOrNo(data){
    if (data){
        return "Yes";
    }
    return "No";
}