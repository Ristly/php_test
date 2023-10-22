<?php
try
{

    $con = new PDO("Строка подключения к бд");
    $k = $con->query('select "dp"."Id" as "parent_id","dp"."DirName" as "parent", "dc"."Id" as "child_id",  "dc"."DirName" as "child" from "public"."Directories" as "dp"
    Right join "public"."Directories" as "dc" on "dc"."Parent_Id" = "dp"."Id"'
    );
    $temp = $k->fetchAll();
    foreach($temp as $value)
    {
        if($value["parent"] == null)
        {
            echo $value["child"];
            echo "<br>";
            $nextId = $value["child_id"];
            unset($value);
            print(PHP_EOL);
            show_childs($temp,$nextId,1);
        }
    }

}
catch(Exception $ev )
{
    echo $ev->getMessage();
}
    
function show_childs($array, $id, $lvl)
{
    foreach($array as $elem)
    {
        if($elem["parent_id"] == $id){
            echo str_repeat('&nbsp',($lvl+1)*2);
            print( $elem["child"]);
            $nextId = $elem["child_id"];
            unset($elem);
            echo "<br>";
            show_childs($array, $nextId, $lvl+1);
            
        }
    }
}

?>