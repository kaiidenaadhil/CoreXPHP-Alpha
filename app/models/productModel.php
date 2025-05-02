<?php
class productModel extends Model
{

	public function record($data = [])
	{
		$this->insert("product", $data);
	}

	public function countAll($search, $searchColumns)
	{
		return $this->searchCount("product", $search, $searchColumns);
	}

	public function displayAll($offset = null, $limit = null)
	{
		$columns = array (
  0 => 'productId',
  1 => 'productName',
  2 => 'price',
  3 => 'stockQuantity',
  4 => 'productType',
  5 => 'status',
  6 => 'categoryId',
  7 => 'productImage',
  8 => 'productCreatedAt',
  9 => 'productUpdatedAt',
  10 => 'productIdentify',
);
		return $this->paginate("product", $columns, [], $offset, $limit);
	}

	public function displayAllSearch($search, $searchColumns, $offset = null, $limit = null)
	{
		$columns = array (
  0 => 'productId',
  1 => 'productName',
  2 => 'price',
  3 => 'stockQuantity',
  4 => 'productType',
  5 => 'status',
  6 => 'categoryId',
  7 => 'productImage',
  8 => 'productCreatedAt',
  9 => 'productUpdatedAt',
  10 => 'productIdentify',
);
		return $this->search("product", $columns, [], $search, $searchColumns, $offset, $limit);
	}

	public function displaySingle($id)
	{
		$columns = array (
  0 => 'productId',
  1 => 'productName',
  2 => 'price',
  3 => 'stockQuantity',
  4 => 'productType',
  5 => 'status',
  6 => 'categoryId',
  7 => 'productImage',
  8 => 'productCreatedAt',
  9 => 'productUpdatedAt',
  10 => 'productIdentify',
);
		return $this->select("product", $columns, ["productIdentify" => $id]);
	}

	public function modify($data, $id)
	{
		return $this->updateWhere("product", $data, ["productIdentify" => $id]);
	}

	public function erase($id)
	{
		return $this->deleteWhere("product", ["productIdentify" => $id]);
	}
}
