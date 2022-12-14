<?php 
namespace App\Models;
 
use CodeIgniter\Model;
 
class BlogModel extends Model
{
    protected $table = 'blog';
    protected $primaryKey = 'id';
    protected $allowedFields = ['blog','parent_id'];

    public function dataMap($nama_tabel,$id,$parent_id,...$arr_fields){
        $db = \Config\Database::connect();
        $fields = implode(',',$arr_fields);
        $hm = "$id,$parent_id ,$fields";
        $builder = $db->table($nama_tabel)->select($hm)->orderBy($parent_id,'ASC');

        $data = $builder->get();

        $result = $data->getResult();

        if( $result> 0 )
    {
        $result = $data->getResultArray();

        foreach( $result as $k => $v )
        {
            $count = 0;
            foreach( $result as $k2 => $v2 )
            {
                if( $v['id'] == $v2['parent_id'] )
                    $count++;
            }

            $mod[] = $v;
        }

        $tree = $this->buildTree($mod);
        $data = [
            "message" => "Get Data Success",
            "data" => $tree
        ];

        echo json_encode($data);
    }
    }
    public function buildTree( array $elements, $parentId = 0 ){
        $branch = array();
    
        foreach( $elements as $element )
        {
            if( $element['parent_id'] == $parentId )
            {
                $children = $this->buildTree($elements, $element['id']);
    
                if( $children )
                {
                    
                    $element['child'] = $children;
                }
    
                $branch[] = $element;   
            }
        }
    
        return $branch;
    }

}