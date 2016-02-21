<?php

class Tovar extends Model{

    public function getList($params){
        $sql = "
        select t.`id`,
		t.`article`,
        t.name,
        t.description,
        t.price,
        t.url_img,
        t.sklad,
        t.brend,
        t.person,
        t.year,
        t.sale,
        u.name as name_category
 from shop.tovary t
join shop.uncategory u on t.id_type = u.id
where u.name = '{$params}'
        ";
        return $this->db->query($sql);
    }
    //ÌÅÒÎÄÛ ÄËß ÎÒÎÁÐÀÆÅÍÈß ÈÃÐÓØÅÊ(ÑÏÈÑÊÎÌ)
    public function getListAdmin(){
        $sql = "select * from tovary where 1";
        return $this->db->query($sql);
    }

    // ÌÅÒÎÄÛ ÄËß ÎÒÎÁÐÀÆÅÍÈß ÊÎÍÊÐÅÒÍÎÃÎ ÒÎÂÀÐÀ
    public function getByTovar($name){
        $name = $this->db->escape($name);
        $sql = "select * from tovary where name = '{$name}' limit 1";
        $result = $this->db->query($sql);
        return isset($result[0]) ? $result[0] : null;
    }

    public function getLatestTovar(){
        $sql = "select * from tovary where 1 order by time limit 4";
        return $this->db->query($sql);
    }

    //ÌÅÒÎÄÛ ÄËß ÄÎÁÀÂËÅÍÈß ÊÎÌÅÍÒÀÐÈÉ Ê ÊÎÍÊÐÅÒÍÎÌÓ ÒÎÂÀÐÓ
    public function getListComent($name){
        $sql = "select * from coment_tovar where name_tovar = '{$name}'";
        //var_dump($sql); die;
        return $this->db->query($sql);
    }

    public function addComent($data, $params){
        if (!isset($data['name'])||!isset($data['text'])){
            return false;
        }
        $name = $this->db->escape($data['name']);
        $text = $this->db->escape($data['text']);
        $time = date("Y.m.d G:i:s", time());
        $name_tovar = $params;
        //echo $time;die;
        $sql = "insert into coment_tovar
                set name = '{$name}',
                text = '{$text}',
                time = '{$time}',
                name_tovar = '{$name_tovar}'
                ";
        return $this->db->query($sql);
    }

    // ÌÅÒÎÄÛ ÄËß ÀÄÌÈÍÀ

    public function getCategory(){
        $sql = "select * from uncategory where 1";
        return $this->db->query($sql);
    }


    /*public function addTovar($data)
    {
        $name = $this->db->escape($data['name']);
        $description = $this->db->escape($data['description']);
        $price = $this->db->escape($data['price']);
        $sql = "insert into tovary
                set name = '{$name}',
                description = '{$description}',
                price = '{$price}'
                ";
        return $this->db->query($sql);
    }*/
    public function delete($id){
        $id = (int)$id;
        $sql = "delete from tovary where id = {$id}";
        return $this->db->query($sql);
    }
    public function save($data, $id = null){
        if ( !isset($data['name']) || !isset($data['description']) || !isset($data['price']) ){
            return false;
        }
        $article = $this->db->escape($data['article']);
        $name = $this->db->escape($data['name']);
        $description = $this->db->escape($data['description']);
        $price = $this->db->escape($data['price']);
        $url_img = $this->db->escape($data['url_img']);
        $sklad = null;
        if(isset($data['sklad'])){
            $sklad = $this->db->escape($data['sklad']);
        } else {
            $sklad = 1;
        }
        $brend = $this->db->escape($data['brend']);
        $person = $this->db->escape($data['person']);
        $year = $this->db->escape($data['year']);
        $sale = null;
        if(isset($data['sale'])){
            $sale = $this->db->escape($data['sale']);
        } else {
            $sale = 1;
        }
        $category = $this->db->escape($data['category']);
        $type = $this->db->escape($data['type']);
        $time = date("Y.m.d G:i:s", time());

        if ( !$id ){ // Add new record
            $sql = "insert into tovary
                set article = '{$article}',
                name = '{$name}',
                description = '{$description}',
                price = '{$price}',
                url_img = '{$url_img}',
                sklad = '{$sklad}',
                brend = '{$brend}',
                person = '{$person}',
                year = '{$year}',
                sale = '{$sale}',
                id_category = '{$category}',
                id_type = '{$type}',
                time = '{$time}'
                ";
        } else { // Update existing record
            $sql = "
                update  tovary
               set article = '{$article}',
                name = '{$name}',
                description = '{$description}',
                price = '{$price}',
                url_img = '{$url_img}',
                sklad = '{$sklad}',
                brend = '{$brend}',
                person = '{$person}',
                year = '{$year}',
                sale = '{$sale}',
                id_category = '{$category}',
                id_type = '{$type}',
                time = '{$time}'
                where id = {$id}
            ";
        }

        return $this->db->query($sql);
    }
    public function getListComentTovar(){
        $sql = "select * from coment_tovar where 1";
        return $this->db->query($sql);

    }
    // ÌÅÒÎÄÛ ÑÎÐÒÈÐÎÂÊÈ

        // ÑÎÐÒÈÐÎÂÊÀ ÏÎ ÖÅÍÅ
        public function getSortPriceABC($category){
            $sql = "
        select t.`id`, t.`article`, t.name, t.description, t.price, t.url_img,
        t.sklad, t.brend, t.person, t.year, t.sale, u.name as name_category
        from shop.tovary t
        join shop.uncategory u on t.id_type = u.id
        where u.name = '{$category}' ORDER by t.price
        ";
            return $this->db->query($sql);
        }
    public function getSortPriceDESC($category){
        $sql = "
        select t.`id`, t.`article`, t.name, t.description, t.price, t.url_img,
        t.sklad, t.brend, t.person, t.year, t.sale, u.name as name_category
        from shop.tovary t
        join shop.uncategory u on t.id_type = u.id
        where u.name = '{$category}' ORDER by t.price DESC
        ";
        return $this->db->query($sql);
    }

    // ÑÎÐÒÈÐÎÂÊÀ ÏÎ ÏÎËÓ
    public function getSortBOY($category){
        $sql = "
        select t.`id`, t.`article`, t.name, t.description, t.price, t.url_img,
        t.sklad, t.brend, t.person, t.year, t.sale, u.name as name_category
        from shop.tovary t
        join shop.uncategory u on t.id_type = u.id
        where u.name = '{$category}' AND t.person = 'boy'
        ";
        return $this->db->query($sql);
    }
    public function getSortGIRL($category){
        $sql = "
        select t.`id`, t.`article`, t.name, t.description, t.price, t.url_img,
        t.sklad, t.brend, t.person, t.year, t.sale, u.name as name_category
        from shop.tovary t
        join shop.uncategory u on t.id_type = u.id
        where u.name = '{$category}' AND t.person = 'girl'
        ";
        return $this->db->query($sql);
    }

    // ÑÎÐÒÈÐÎÂÊÀ ÏÎ ÂÎÇÐÀÑÒÓ
    public function getSortYear1($category){
        $sql = "
        select t.`id`, t.`article`, t.name, t.description, t.price, t.url_img,
        t.sklad, t.brend, t.person, t.year, t.sale, u.name as name_category
        from shop.tovary t
        join shop.uncategory u on t.id_type = u.id
        where u.name = '{$category}' AND YEAR = '1'
        ";
        return $this->db->query($sql);
    }
    public function getSortYear1and2($category){
        $sql = "
        select t.`id`, t.`article`, t.name, t.description, t.price, t.url_img,
        t.sklad, t.brend, t.person, t.year, t.sale, u.name as name_category
        from shop.tovary t
        join shop.uncategory u on t.id_type = u.id
        where u.name = '{$category}' AND YEAR = '1-2'
        ";
        return $this->db->query($sql);
    }
    public function getSortYear2and3($category){
        $sql = "
        select t.`id`, t.`article`, t.name, t.description, t.price, t.url_img,
        t.sklad, t.brend, t.person, t.year, t.sale, u.name as name_category
        from shop.tovary t
        join shop.uncategory u on t.id_type = u.id
        where u.name = '{$category}' AND YEAR = '2-3'
        ";
        return $this->db->query($sql);
    }
    public function getSortYear3and5($category){
        $sql = "
        select t.`id`, t.`article`, t.name, t.description, t.price, t.url_img,
        t.sklad, t.brend, t.person, t.year, t.sale, u.name as name_category
        from shop.tovary t
        join shop.uncategory u on t.id_type = u.id
        where u.name = '{$category}' AND YEAR = '3-5'
        ";
        return $this->db->query($sql);
    }
    public function getSortYear5and7($category){
        $sql = "
        select t.`id`, t.`article`, t.name, t.description, t.price, t.url_img,
        t.sklad, t.brend, t.person, t.year, t.sale, u.name as name_category
        from shop.tovary t
        join shop.uncategory u on t.id_type = u.id
        where u.name = '{$category}' AND YEAR = '5-7'
        ";
        return $this->db->query($sql);
    }
    public function getSortYear7and11($category){
        $sql = "
        select t.`id`, t.`article`, t.name, t.description, t.price, t.url_img,
        t.sklad, t.brend, t.person, t.year, t.sale, u.name as name_category
        from shop.tovary t
        join shop.uncategory u on t.id_type = u.id
        where u.name = '{$category}' AND YEAR = '7-11'
        ";
        return $this->db->query($sql);
    }
    public function getSortYear11and16($category){
        $sql = "
        select t.`id`, t.`article`, t.name, t.description, t.price, t.url_img,
        t.sklad, t.brend, t.person, t.year, t.sale, u.name as name_category
        from shop.tovary t
        join shop.uncategory u on t.id_type = u.id
        where u.name = '{$category}' AND YEAR = '11-16'
        ";
        return $this->db->query($sql);
    }
    public function getSortYear16($category){
        $sql = "
        select t.`id`, t.`article`, t.name, t.description, t.price, t.url_img,
        t.sklad, t.brend, t.person, t.year, t.sale, u.name as name_category
        from shop.tovary t
        join shop.uncategory u on t.id_type = u.id
        where u.name = '{$category}' AND YEAR = '16+'
        ";
        return $this->db->query($sql);
    }


}