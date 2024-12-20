<header class="page-header">
  <div class="container-fluid">
    <h2 class="no-margin-bottom">Kitap Detayları</h2>
  </div>
</header>

<div class="table-agile-info">
	<div class="container-fluid my-3">
		<?php if ($this->session->flashdata('message')!=null) {
		echo "<br><div class='alert alert-success alert-dismissible fade show' role='alert'>"
			.$this->session->flashdata('message')."<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
			<span aria-hidden='true'>&times;</span>
			</button> </div>";
		} ?>
		<br>
		<div class="card rounded-0 shadow">
			<div class="card-header">
				<a href="#add" data-toggle="modal" class="btn btn-primary btn-sm rounded-0 pull-right"><i class="fa fa-plus"></i> Yeni Kitap Ekle</a>
			</div>
			<div class="card-body">
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
							<td>Kitap Adı</td>
							<td>Kapak</td>
							<td>Yıl</td>
							<td>Fiyat</td>
							<td>Kategori</td>
							<td>Yayınevi</td>
							<td>Yazar</td>
							<td>Stok</td>
							<td>İşlem</td>
						</tr></thead>
						<tbody style="background-color: white;">
						<?php $no=0; foreach ($get_book as $book) : $no++;?>

						<tr>
							<td><?=$no?></td>
							<td><?=$book->book_title?></td>
							<td><img src="<?=base_url('assets/gambar/'.$book->book_img)?>" style="width:40px"></td>
							<td><?=$book->year?></td>
							<td>₺<?=number_format($book->price)?></td>
							<td><?=$book->category_name?></td>
							<td><?=$book->publisher?></td>
							<td><?=$book->writer?></td>
							<td><?=$book->stock?></td>
							<td class="text-center">
								<a href="#edit" onclick="edit('<?=$book->book_code?>')" class="btn btn-primary btn-sm rounded-0" data-toggle="modal"><i class="fa fa-pencil"></i></a>
								<a href="<?=base_url('index.php/kitap/delete/'.$book->book_code)?>" onclick="return confirm('Bu kitabı silmek istediğinizden emin misiniz?')" class="btn btn-danger btn-sm rounded-0"><i class="fa fa-trash"></i></a>
							</td>
						</tr>
					<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="modal" id="add">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					Yeni Kitap Ekle
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
					</button>
				</div>
				<form action="<?=base_url('index.php/kitap/add')?>" method="post" enctype="multipart/form-data">
					<div class="modal-body">
						<div class="form-group row">
							<div class="col-sm-3 offset-1"><label>Kitap Adı</label></div>
							<div class="col-sm-7">
								<input type="text" name="book_title" required="form-control" class="form-control">
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-3 offset-1"><label>Yıl</label></div>
							<div class="col-sm-7">
								<input type="number" name="year" required="form-control" class="form-control">
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-3 offset-1"><label>Fiyat</label></div>
							<div class="col-sm-7">
								<input type="number" name="price" required="form-control" class="form-control">
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-3 offset-1"><label>Kategori</label></div>
							<div class="col-sm-7">
								<select name="category" required="form-control" class="form-control">
									<?php foreach ($category as $kat): ?>
										<option value="<?=$kat->category_code?>">
											<?=$kat->category_name ?>
										</option> 
									<?php endforeach ?>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-3 offset-1"><label>Kapak Fotoğrafı</label></div>
							<div class="col-sm-7">
								<input type="file" name="gambar" class="form-control">
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-3 offset-1"><label>Yayınevi</label></div>
							<div class="col-sm-7">
								<input type="text" name="publisher" required="form-control" class="form-control">
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-3 offset-1"><label>Yazar</label></div>
							<div class="col-sm-7">
								<input type="text" name="writer" required="form-control" class="form-control">
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-3 offset-1"><label>Stok</label></div>
							<div class="col-sm-7">
								<input type="number" name="stock" required="form-control" class="form-control">
							</div>
						</div>
					</div>
					<div class="modal-footer justify-content-end">
						<input type="submit" name="save" value="Kaydet" class="btn btn-primary btn-sm rounded-0">
						<button type="button" class="btn btn-default btn-sm border rounded-0" data-dismiss="modal">Kapat</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="edit">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					Kitap Güncelle
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
					</button>
				</div>
				<form action="<?=base_url('index.php/kitap/update')?>" method="post" enctype="multipart/form-data">
					<input type="hidden" name="book_code" id="book_code">
					<div class="modal-body">
						<div class="form-group row">
							<div class="col-sm-3 offset-1"><label>Kitap Adı</label></div>
							<div class="col-sm-7">
								<input type="text" name="book_title" id="book_title" class="form-control">
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-3 offset-1"><label>Yıl</label></div>
							<div class="col-sm-7">
								<input type="number" name="year" id="year" class="form-control">
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-3 offset-1"><label>Fiyat</label></div>
							<div class="col-sm-7">
								<input type="number" name="price" id="price" class="form-control">
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-3 offset-1"><label>Kategori</label></div>
							<div class="col-sm-7">
								<select name="category" id="category" class="form-control">
									<?php foreach ($category as $kat): ?>
										<option value="<?=$kat->category_code?>">
											<?=$kat->category_name ?>
										</option> <?php endforeach ?>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-3 offset-1"><label>Kapak Fotoğrafı</label></div>
							<div class="col-sm-7">
								<input type="file" name="gambar" id="gambar" class="form-control">
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-3 offset-1"><label>Yayınevi</label></div>
							<div class="col-sm-7">
								<input type="text" name="publisher" id="publisher" class="form-control">
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-3 offset-1"><label>Yazar</label></div>
							<div class="col-sm-7">
								<input type="text" name="writer" id="writer" class="form-control">
							</div>
						</div>
						<div class="form-group row">
							<div class="col-sm-3 offset-1"><label>Stok</label></div>
							<div class="col-sm-7">
								<input type="number" name="stock" id="stock" class="form-control">
							</div>
						</div>
					</div>
					<div class="modal-footer justify-content-end">
						<input type="submit" name="save" value="Kaydet" class="btn btn-primary btn-sm rounded-0">
						<button type="button" class="btn btn-default btn-sm border rounded-0" data-dismiss="modal">Kapat</button>
					</div>
				</form>
			</div>
			
		</div>
	</div>
</div>


<script type="text/javascript">
	$(document).ready(function(){
			$('#example').DataTable();
		}
	);
	function edit(a) {
		$.ajax({
			type:"post",
			url:"<?=base_url()?>index.php/kitap/edit_book/"+a,
			dataType:"json",
			success:function(data){
				$("#book_code").val(data.book_code);
				$("#book_title").val(data.book_title);
				$("#year").val(data.year);
				$("#price").val(data.price);
				$("#category").val(data.category_code);
				$("#publisher").val(data.publisher);
				$("#writer").val(data.writer);
				$("#stock").val(data.stock);

			}
		});
	}
</script>
