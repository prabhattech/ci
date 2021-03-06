    <?php $this->load->view('admin/include/header');?>
      <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?=base_url('admin/dashboard');?>">Home</a></li>
            <li class="breadcrumb-item active">Users Add       </li>
          </ul>
        </div>
      </div>
      <section>
        <div class="container-fluid">
          <header>
            <div class="row">
                <div class="col-md-6">
                  <h1 class="h3 display">Add Users              </h1>
                </div>
                <div class="col-md-6 ">
                  <a href="<?=base_url('admin/manage_user')?>" class="btn btn-primary pull-right">LIST</a>
                </div>
            </div> 
          </header>
          <div class="row">
            <div class="col-lg-10">
              <div class="card">
                <div class="card-header">
                  <h4>Add New Users</h4>
                </div>
                <div class="card-body">                                
                  <form role="form" method="post" id="add_contant_form">
                    <input type="hidden" name="id" id="id" value="<?=isset($record['id'])?$record['id']:''?>">
                    <div class="form-group">
                      <label>Name</label>
                      <input name="name" type="text" required class="form-control" value="<?=isset($record['name'])?$record['name']:''?>">
                    </div>
                    <div class="form-group">
                      <label>Father's Name</label>
                      <input name="father_name" type="text" required class="form-control" value="<?=isset($record['father_name'])?$record['father_name']:''?>">
                    </div>
                    <div class="form-group">
                      <label>Email</label>
                      <input name="email" type="email" required class="form-control" value="<?=isset($record['email'])?$record['email']:''?>">
                    </div>
                    <?php if (isset($record['password']) && !empty($record['password'])) {
                      
                    } else {?>
                    <div class="form-group">
                      <label>Password</label>
                      <input name="password" type="password" required class="form-control">
                    </div>
                    <?php  }?>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Address</label>
                        <textarea class="form-control" name="address" id="address"><?=isset($record['address'])?$record['address']:''?></textarea>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Image</label>
                        <input name="image" type="file" class="form-control-file" value="<?=isset($record['image'])?$record['image']:''?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Status</label>
                      <select class="form-control" name="status" id="status">
                          <option value="1" <?php if(isset($record['status']) && $record['status']=='1'){echo 'selected';}?>>Active</option>
                          <option value="0" <?php if(isset($record['status']) && $record['status']=='0'){echo 'selected';}?>>Deactive</option>
                      </select>
                    </div>
                    <div class="form-group">       
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <?php $this->load->view('admin/include/footer');?>
<script type="text/javascript">
  CKEDITOR.replace('content', {
        filebrowserImageUploadUrl : baseUrl + 'ckeditor/image_upload',
        filebrowserUploadMethod: 'form'
    });

    $('#add_contant_form').bind('submit', function () {
      for (instance in CKEDITOR.instances) {
        CKEDITOR.instances[instance].updateElement();
    }

      var id = $("#id").val();

      if (id!='') {
          var url = '<?=base_url("admin/manage_user/edit/");?>'+id;
      }else{
          var url = '<?=base_url("admin/manage_user/add/");?>';
      }
    
    var form_data = new FormData($('#add_contant_form')[0]);
      $.ajax({
        type: 'post',
        url: url,
        data: form_data,
        processData: false,
        contentType: false,
        success: function (data) {
          $("#add_contant_form")[0].reset();
          var data = jQuery.parseJSON(data);
           Swal.fire({
              icon: data.status,
              title: data.message,
              showConfirmButton: false,
              timer: 2500
            });
            setTimeout(function() {
              window.location.href = '<?=base_url("admin/manage_user");?>';
            }, 2500);
        }
      });
      return false;
    });

</script>