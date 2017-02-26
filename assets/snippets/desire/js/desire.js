
/**
 * Created by admin on 16.01.2017.
 */


$('body').on('click','.add-to-desire',function (e) {
    alert(1)

    var id = $(this).data('id')
    var obj = $(this)
    $.get('add-to-desire',{id:id},function () {
        obj.removeClass('add-to-desire');
        obj.addClass('delete-from-desire');
    })
    e.preventDefault()
})

$('body').on('click','.delete-from-desire',function (e) {
    var id = $(this).data('id')
    var obj = $(this)
    e.preventDefault()
    $.get('delete-from-desire',{id:id},function () {
        obj.addClass('add-to-desire');
        obj.removeClass('delete-from-desire');
    })
    e.preventDefault()
})