       <!-- partial:partials/_footer.html -->
       <footer class="footer">
           <div class="d-sm-flex justify-content-center justify-content-sm-between">
               <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021. Premium <a
                       href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from Skydash.
                   All rights reserved.</span>
               <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i
                       class="ti-heart text-danger ml-1"></i></span>
           </div>
           <div class="d-sm-flex justify-content-center justify-content-sm-between">
           </div>
       </footer>
       <!-- partial -->
       </div>
       <!-- main-panel ends -->
       </div>
       <!-- page-body-wrapper ends -->
       </div>
       <!-- container-scroller -->

       <!-- delete modal -->
       <div class="modal fade" id="exampleModalLongg" tabindex="-1" role="dialog"
           aria-labelledby="exampleModalLonggTitle" aria-hidden="true">
           <div class="modal-dialog" role="document">
               <div class="modal-content">
                   <div class="modal-header">
                       <h5 class="modal-title" id="exampleModalLonggTitle">Are you sure?</h5>
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                       </button>
                   </div>
                   <div class="modal-body">
                       Do you really want to delete this account?
                   </div>
                   <div class="modal-footer">
                       <button type="button" class="btn btn-success text-white" data-dismiss="modal">No</button>
                       <form action="delete.php" method="POST">
                           <input type="hidden" name="yes" value="" id="delete-btn">
                           <button type="submit" name="no" id="heewk"
                               class="btn btn-danger text-white modal-btn">Yes</button>
                       </form>
                   </div>
               </div>
           </div>
       </div>

       <!-- remove admin modal -->
       <div class="modal fade" id="exampleModalLonggg" tabindex="-1" role="dialog"
           aria-labelledby="exampleModalLongggTitle" aria-hidden="true">
           <div class="modal-dialog" role="document">
               <div class="modal-content">
                   <div class="modal-header">
                       <h5 class="modal-title" id="exampleModalLongggTitle">Are you sure?</h5>
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                       </button>
                   </div>
                   <div class="modal-body">
                       Do you really want to remove this account as an admin?
                   </div>
                   <div class="modal-footer">
                       <button type="button" class="btn btn-success text-white" data-dismiss="modal">No</button>
                       <form action="remove_admin.php" method="POST">
                           <input type="hidden" name="remove" value="" id="remove-btn">
                           <button type="submit" class="btn btn-danger text-white modal-btn">Yes</button>
                       </form>
                   </div>
               </div>
           </div>
       </div>

       <!-- Add admin modal -->
       <div class="modal fade" id="exampleModalLongge" tabindex="-1" role="dialog"
           aria-labelledby="exampleModalLonggeTitle" aria-hidden="true">
           <div class="modal-dialog" role="document">
               <div class="modal-content">
                   <div class="modal-header">
                       <h5 class="modal-title" id="exampleModalLonggeTitle">Are you sure?</h5>
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                       </button>
                   </div>
                   <div class="modal-body">
                       Do you really want to elevate this profile to admin status?
                   </div>
                   <div class="modal-footer">
                       <button type="button" class="btn btn-success text-white" data-dismiss="modal">No</button>
                       <form action="add_new_admin.php" method="POST">
                           <input type="hidden" name="addadmin" value="" id="addadmin-btn">
                           <button type="submit" name="no" id="heewk"
                               class="btn btn-danger text-white modal-btn">Yes</button>
                       </form>
                   </div>
               </div>
           </div>
       </div>