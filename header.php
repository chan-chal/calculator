<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">My Web</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="display.php">Profile</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="alldata.php">Home</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link " href="addnewuser.php">Add New User</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link " id="myButton" data-toggle="modal" data-target="mymodal" href="">Logout</a>
            </li>
            <!-- <button type="button" class="btn btn-primary" id="myButton">Open Modal</button> -->
            
    </div>
</nav>

    <!-- Logout modal -->
    <!-- <div class="modal fade" id="#exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Are you sure?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Do you really want to logout?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success text-white" data-dismiss="modal"><a href="display.php"
                            class="modal-button">No</a></button>
                    <button type="button" class="btn btn-danger text-white"><a class="modal-button"
                            href="logout.php">Yes</a></button>
                </div>
            </div>
        </div>
    </div> -->


<!-- Button trigger modal -->


  <!-- Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal header -->
        <div class="modal-header">
          <h5 class="modal-title">Are you sure?</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <p>Do you really want to logout?</p>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
        <button type="button"  class="btn btn-success"  data-dismiss="modal">No</button>

        <div>
    <button  onclick="redirectToPage()" type="button"  class="btn btn-danger"  data-dismiss="modal">Yes</button>
        </div>
        </div>
        
      </div>
    </div>
  </div>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <script>
    // JavaScript to show the modal when the button is clicked
    document.getElementById('myButton').addEventListener('click', function() {
      $('#myModal').modal('show');
    });
  </script>

<script>
function redirectToPage() {
  window.location.href = "logout.php";
}
</script>