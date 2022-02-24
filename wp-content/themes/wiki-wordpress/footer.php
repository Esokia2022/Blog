<?php
/** 
 * The theme footer.
 * 
 * @package bootstrap-basic4
 */
?>

        <footer class="footer">
            <div class="container">
                <div class="col-12">
                    <div class="text-footer">© 2022 Wiki WordPress</div>
                </div>
            </div>
        </footer>
        <!-- Modal : Delete subject -->
        <button style="display:none" type="button" id="btn-popup" class="btn btn-primary" data-toggle="modal" data-target="#successMessage">
        Launch demo modal
        </button>
        <div class="modal fade" id="successMessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <!-- <h5 class="modal-title" id="exampleModalLongTitle">Liste des etudiants</h5> -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>

            <div class="modal-body">
                <div class="successMessage">
                </div>
            </div>
            </div>
        </div>
        </div>
        <!--/ Modal : Delete subject -->

        <!--WordPress footer-->
        <?php wp_footer(); ?> 
        <!--end WordPress footer-->
    </body>
</html>