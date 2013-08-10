jQuery(document).ready(function ($)
{
    $(".showLoading").hide();
    $("#updateDiv").hide();

    $('#settings-form').submit(function (e)
    {
        $(".showLoading").show();
        $(".tips").removeClass('alert alert-error');
        $(".tips").html("");

        var $form = $(this);
        // Disable the submit button
        $form.find('button').prop('disabled', true);

        $.ajax({
            type:"POST",
            url:admin_ajaxurl,
            data:$form.serialize(),
            cache:false,
            dataType:"json",
            success:function (data)
            {
                $(".showLoading").hide();
                // re-enable the submit button
                $form.find('button').prop('disabled', false);

                if (data.success)
                {
                    $("#updateMessage").text("Settings updated");
                    $("#updateDiv").addClass('updated').show();
                }
                else
                {
                    // show the errors on the form
                    $(".tips").addClass('alert alert-error');
                    $(".tips").html(data.msg);
                    $(".tips").fadeIn(500).fadeOut(500).fadeIn(500);
                }
            }
        });
        return false;
    });


    function resetForm($form)
    {
        $form.find('input:text, input:password, input:file, select, textarea').val('');
        $form.find('input:radio, input:checkbox')
            .removeAttr('checked').removeAttr('selected');
    }

    function validField(field, fieldName, errorField)
    {
        var valid = true;
        if (field.val() === "")
        {
            errorField.addClass('alert alert-error');
            errorField.html("<p>" + fieldName + " must contain a value</p>");
            valid = false;
        }
        return valid;
    }


});