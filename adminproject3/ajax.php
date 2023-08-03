<!-- <script src="jquery-3.6.4.min.js"></script> -->
<script src="bootstrap/js/jquery.js"></script>
<a href="javascript:void(0)" onclick="click_here()">Click here</a>

<script>
function click_here(){
    jQuery.ajax({
    url:'get.php',
    type:'get',
    success:function(result)
    {
        alert(result);
    }
});
}

</script>