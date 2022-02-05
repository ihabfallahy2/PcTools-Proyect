<?php
session_start();
if (isset($_REQUEST['cod'])){
    echo $_REQUEST['cod'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>PcTools - Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<!-- <div class="modal fade" role="dialog" tabindex="-1" id="user-form-modal"> -->
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Editar Producto</h5>
            <button type="button" class="close" data-dismiss="modal">
              <!-- <span aria-hidden="true">×</span> -->
            </button>
          </div>
          <div class="modal-body">
            <div class="py-1">
              <form class="form" novalidate="">
                <div class="row">
                  <div class="col">
                    <div class="row">
                      <div class="col">
                        <div class="form-group">
                          <label>Codigo</label>
                          <input class="form-control" type="text" name="name" placeholder="<?php echo $_REQUEST['cod'];?>" value="<?php echo $_REQUEST['cod'];?>">
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-group">
                          <label>Nombre_Corto</label>
                          <input class="form-control" type="text" name="username" placeholder="johnny.s" value="johnny.s">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col">
                        <div class="form-group">
                          <label>Email</label>
                          <input class="form-control" type="text" placeholder="user@example.com">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col mb-3">
                        <div class="form-group">
                          <label>About</label>
                          <textarea class="form-control" rows="5" placeholder="My Bio"></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 col-sm-6 mb-3">
                    <div class="mb-2"><b>Change Password</b></div>
                    <div class="row">
                      <div class="col">
                        <div class="form-group">
                          <label>Current Password</label>
                          <input class="form-control" type="password" placeholder="••••••">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col">
                        <div class="form-group">
                          <label>New Password</label>
                          <input class="form-control" type="password" placeholder="••••••">
                        </div>
                      </div>
                      <div class="col">
                        <div class="form-group">
                          <label>Confirm <span class="d-none d-xl-inline">Password</span></label>
                          <input class="form-control" type="password" placeholder="••••••"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-sm-5 offset-sm-1 mb-3">
                    <div class="mb-2"><b>Keeping in Touch</b></div>
                    <div class="row">
                      <div class="col">
                        <label>Email Notifications</label>
                        <div class="custom-controls-stacked px-2">
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="notifications-blog" checked="">
                            <label class="custom-control-label" for="notifications-blog">Blog posts</label>
                          </div>
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="notifications-news" checked="">
                            <label class="custom-control-label" for="notifications-news">Newsletter</label>
                          </div>
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="notifications-offers" checked="">
                            <label class="custom-control-label" for="notifications-offers">Personal Offers</label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col d-flex justify-content-end">
                    <button class="btn btn-primary" name="guardar" type="submit">Save Changes</button>
                  </div>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
</body>