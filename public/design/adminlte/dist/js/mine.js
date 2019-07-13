function check_all(){
    $('input[class="del_checkbox"]:checkbox').each(function(){
        if($('input[class="check_all"]:checkbox:checked').length==0){
            $(this).prop('checked' , false)
        }
        else
            $(this).prop('checked' , true)
    });
}
function delete_all(){
    $(document).on('click' , '.delBtn' , function(){
        let checked_count = $('input[class="del_checkbox"]:checkbox:checked').filter(":checked").length;
        if( checked_count > 0)
        {
            $('.empty_record').addClass('hidden');
            $('.record-count').text(checked_count);
            $('.not_empty_record').removeClass('hidden');

        } else {
            $('.record-count').text('');
            $('.empty_record').removeClass('hidden');
            $('.not_empty_record').addClass('hidden');
        }
        $('#multipleDelete').modal()
    })
    $(".del_all").click(function(){
        $("#form_data").submit();
    })
}

