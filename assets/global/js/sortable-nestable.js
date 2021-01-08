'use strict';
$(function(){
    $('.dd').nestable({
        group: 1,
        maxDepth: 2
    }).on('change',function(e){
        var list = e.length ? e : $(e.target);
          
        $.ajax({
            type: "POST",
            dataType: "json",
            url: base+"ubahPosisiMenu",
            data: {data:list.nestable('serialize')},
            success: function(response)
            {
            	if (response) {
                    alertInfo('Please Wait')
            	}
            }
        })
    })
});
// $("#menu").livequery(function () {

//     $('.dd').on('change', function () {
//         var $this = $(this);
//         var serializedData = window.JSON.stringify($($this).nestable('serialize'));

//         $this.parents('div.body').find('textarea').val(serializedData);
//     });
// });