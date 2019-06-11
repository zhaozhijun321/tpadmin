define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'cms/kecheng/index',
                    add_url: 'cms/kecheng/add',
                    edit_url: 'cms/kecheng/edit',
                    del_url: 'cms/kecheng/del',
                    multi_url: 'cms/kecheng/multi',
                    table: 'kecheng',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', sortable: true, title: __('Id')},
                        {field: 'channel.name', title: __('所属栏目'),
                            formatter: Table.api.formatter.search
                            },
                        {field: 'chanpin.title', title: __('Title'),formatter: Table.api.formatter.search},
                        {field: 'begintime', title: __('开始时间'), sortable: true, operate: 'RANGE', addclass: 'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'endtime', title: __('结束时间'), sortable: true, operate: 'RANGE', addclass: 'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'status', title: __('Status'), formatter: Table.api.formatter.status},
                         {
                            field: 'operate',
                            title: __('Operate'),
                            table: table,
                            events: Table.api.events.operate,
                            formatter: Table.api.formatter.operate
                        }
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        add: function () {

                 //课程专家筛选
           $(document).on('change', '#channel_id', function () {
                Fast.api.ajax({
                    url: 'cms/kecheng/getlist',
                    data: {channel_id: $(this).val()}
                }, function (data) {
                    $("#extend").html(data.html);
                    Form.api.bindevent($("#extend"));
                    return false;
                });
                localStorage.setItem('last_channel_id', $(this).val());
            });
           var last_channel_id = localStorage.getItem('last_channel_id');
            if (last_channel_id) {
                $("#channel_id option[value='" + last_channel_id + "']").prop("selected", true);
            }
            $("#channel_id").trigger("change");
            Controller.api.bindevent();
        },
        edit: function () {
                  //课程专家筛选
            Controller.api.bindevent();
            Fast.api.ajax({
                    url: 'cms/kecheng/getlist',
                    data: {channel_id: $('#c-channel_id').val(),id:$('[name=id]').val()}
                }, function (data) {
                    $("#extend").html(data.html);
                    Form.api.bindevent($("#extend"));
                    return false;
                });
                 //课程专家筛选
           $(document).on('change', '#c-channel_id', function () {
                Fast.api.ajax({
                    url: 'cms/kecheng/getlist',
                    data: {channel_id: $(this).val()}
                }, function (data) {
                    $("#extend").html(data.html);
                    Form.api.bindevent($("#extend"));
                    return false;
                });
            });

        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            }

        }
    };
    return Controller;
});