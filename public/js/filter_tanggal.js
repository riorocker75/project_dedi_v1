$(document).ready(function () {
    $('#filter_tanggal').click(function (e) { 
        var dari=  $("#dari").val();
        var sampai=  $("#sampai").val();
        if(dari != '' && sampai != ''){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                type:"post",
                url:"/ajax/filter-shu",
                data:{dari:dari,sampai:sampai},
                success: function(data){          
                    $('.hasil_filter').html(data);
                }
            });
            $('#data1').DataTable().destroy();
            $('#data1').css('display','none');
            $('#hilang').css('display','none');
            $('#lap_all').css('display','none');
            $('#lap_filter').css('display','block');

        }else{
            alert('Wajib isi keduanya untuk bisa menampilkan laporan');
        }
    //    $('#hilang').hide();
        
    });
});