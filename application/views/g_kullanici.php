<header class="page-header">
  <div class="container-fluid">
    <h2 class="no-margin-bottom">Sistem Kullanıcıları</h2>
  </div>
</header>

<div class="table-agile-info">
	<div class="panel panel-default">

		<div class="container-fluid">
			<?php if ($this->session->flashdata('message')!=null) {
			echo "<br><div class='alert alert-success alert-dismissible fade show' role='alert'>"
				.$this->session->flashdata('message')."<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
				<span aria-hidden='true'>&times;</span>
				</button> </div>";
			} ?>
			<br><a href="#add" data-toggle="modal" class="btn btn-primary pull-left"><i class="fa fa-plus"></i> Yeni Sistem Kullanıcı Ekle</a><br>
			<table class="table table-hover table-bordered" id="example" ui-options=ui-options="{
			        &quot;paging&quot;: {
			          &quot;enabled&quot;: true
			        },
			        &quot;filtering&quot;: {
			          &quot;enabled&quot;: true
			        },
			        &quot;sorting&quot;: {
			          &quot;enabled&quot;: true
			        }}">
				<thead style="background-color: #464b58; color:white;">
					<tr>
						<td>#</td>
						<td>Ad Soyad</td>
						<td>Kullanıcı Adı</td>
						<td>Yetki</td>
						<td>İşlem</td>
					</tr></thead>
				<tbody style="background-color: white;">
					<?php $no=0; foreach ($get_user as $user) : $no++;?>

					<tr>
						<td><?=$no?></td>
						<td><?=$user->fullname?></td>
						<td><?=$user->username?></td>
						<td><?=$user->level?></td>
						<td>
							<a href="#edit" onclick="edit('<?=$user->user_code?>')" class="btn btn-success btn-sm" data-toggle="modal">Düzenle</a>
							<a href="<?=base_url('index.php/kullanici/delete/'.$user->user_code)?>" onclick="return confirm('Bu kullanıcıyı silmek istediğinizden emin misiniz?')" class="btn btn-danger btn-sm">Sil</a>
						</td>
					</tr>
				<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>

	<div class="modal" id="add">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					Yeni Sistem Kullanıcı Ekle
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
					<span class="sr-only">Kapat</span>
					</button>
				</div>
				<form action="<?=base_url('index.php/kullanici/add')?>" method="post">
					<div class="modal-body">
						<div class="form-group row">
							<div class="col-sm-3 offset-1"><label>Ad Soyad</label></div>
							<div class="col-sm-7">
								<input type="text" name="fullname" required class="form-control">
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-3 offset-1"><label>Kullanıcı Adı</label></div>
							<div class="col-sm-7">
								<input type="text" name="username" required class="form-control">
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-3 offset-1"><label>Şifre</label></div>
							<div class="col-sm-7">
								<input type="password" name="password" required class="form-control">
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-3 offset-1"><label>Yetki</label></div>
							<div class="col-sm-7">
								<select type="text" name="level" required class="form-control">
								 	<option value="admin">yönetici</option>
								 	<option value="cashier">kasiyer</option>
								</select> 
							</div>
						</div>
					</div>
					<div class="modal-footer justify-content-between">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
						<input type="submit" name="save" value="Kaydet" class="btn btn-success">
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="edit">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					Kullanıcı Bilgilerini Güncelle
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
					<span class="sr-only">Kapat</span>
					</button>
				</div>
				<form action="<?=base_url('index.php/kullanici/update')?>" method="post">
					<div class="modal-body">
						<input type="hidden" name="user_code_lama" id="user_code_lama">
						<div class="form-group row">
							<div class="col-sm-3 offset-1"><label>Ad Soyad</label></div>
							<div class="col-sm-7">
								<input type="text" name="fullname" id="fullname" required class="form-control">
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-3 offset-1"><label>Kullanıcı Adı</label></div>
							<div class="col-sm-7">
								<input type="text" name="username" id="username" required class="form-control">
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-3 offset-1"><label>Şifre</label></div>
							<div class="col-sm-7">
								<input type="password" name="password" id="password" required class="form-control">
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-3 offset-1"><label>Yetki</label></div>
							<div class="col-sm-7">
								<select type="text" name="level" id="level" required class="form-control">
									<option value="admin">yönetici</option>
									<option value="cashier">kasiyer</option>
								</select>
							</div>
						</div>
					</div>
					<div class="modal-footer justify-content-between">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
						<input type="submit" name="edit" value="Kaydet" class="btn btn-success">
					</div>
				</form>
			</div>
			
		</div>
	</div>
</div>


<script type="text/javascript">
	$(document).ready(function(){
		$('#example').DataTable();
	});
	
	function edit(a) {
		$.ajax({
			type: "post",
			url: "<?=base_url()?>index.php/kullanici/edit_user/"+a,
			dataType: "json",
			success: function(data) {
				$("#fullname").val(data.fullname);
				$("#username").val(data.username);
				$("#level").val(data.level);
				$("#user_code_lama").val(data.user_code);
			}
		});
	}
</script>
