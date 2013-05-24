
window.entryDel = function (btn) {
    var li = $(btn).parent('li');
    $.get(
        '/'+li.data('id')+'/del',
        {},
        function (ret) {
            console.log(ret);
            li.hide('fast', function () { li.remove(); });
        },
        'json'
    );
};

window.entryAdd = function (input) {
    var title = $(input).val();
    var entry = $(input).closet('li');
    $.post(
        '/add',
        {
            title: title
        },
        function (ret) {
            var ul = entry.parent('ul');
            entry.remove();
            ul.append(ret);
        },
        'html'
    );
};
window.entryEdit = function (input) {
    var title = $(input).val();
    var entry = $(input).closet('li');
    var id = entry.data('id');
    $.post(
      '/'+id+'/edit',
      {
        title: title
      },
      function (ret) {
        console.log('edit ok');
      },
      'json'
    );
};
window.entryToogle = function (checkbox) {
    var entry = $(checkbox).closet('li');
    var id = entry.data('id');
    $.post(
        '/'+id+'/edit',
        {
            is_done: $(checkbox).prop('checked') ? 1 : 0
        },
        function (ret) {

        },
        'json'
    );
};