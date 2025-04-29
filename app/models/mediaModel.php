<?php
class mediaModel extends Model
{

	public function record($data = [])
	{
		$this->insert("media", $data);
	}

	public function countAll($search, $searchColumns)
	{
		return $this->searchCount("media", $search, $searchColumns);
	}

	public function displayAll($offset = null, $limit = null)
	{
		$columns = array (
  0 => 'mediaId',
  1 => 'media',
  2 => 'mediaType',
  3 => 'mediumCreatedAt',
  4 => 'mediumUpdatedAt',
  5 => 'mediumIdentify',
);
		return $this->paginate("media", $columns, [], $offset, $limit);
	}

	public function displayAllSearch($search, $searchColumns, $offset = null, $limit = null)
	{
		$columns = array (
  0 => 'mediaId',
  1 => 'media',
  2 => 'mediaType',
  3 => 'mediumCreatedAt',
  4 => 'mediumUpdatedAt',
  5 => 'mediumIdentify',
);
		return $this->search("media", $columns, [], $search, $searchColumns, $offset, $limit);
	}

	public function displaySingle($id)
	{
		$columns = array (
  0 => 'mediaId',
  1 => 'media',
  2 => 'mediaType',
  3 => 'mediumCreatedAt',
  4 => 'mediumUpdatedAt',
  5 => 'mediumIdentify',
);
		return $this->select("media", $columns, ["mediumIdentify" => $id]);
	}

	public function modify($data, $id)
	{
		return $this->updateWhere("media", $data, ["mediumIdentify" => $id]);
	}

	public function erase($id)
	{
		return $this->deleteWhere("media", ["mediumIdentify" => $id]);
	}
}
