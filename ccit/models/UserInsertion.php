<?php

class UserInsertion extends CI_Model {
    /*
     * 
     */

    public function insertion($param, $paran1,$param3) {
        $this->db->trans_begin();
        $this->db->insert('users', $param);
        $insert_id = $this->db->insert_id();
        $array = array("userid" => $insert_id);
        $final = array_merge($array, $paran1);
        $this->db->insert('user_information', $final);
        $finalloc = array_merge($array, $param3);
        $this->db->insert('user_locations', $finalloc);
       
       if ($this->db->trans_status() === FALSE) {
            return $this->db->trans_rollback();
        } else {
             $this->db->trans_commit();
             return $insert_id;
        }
    }
        public function updationUsers($id,$param) 
        {
                $this->db->where("id",$id);   
           $this->db->update('users', $param);
         $afftectedRows=$this->db->affected_rows();
         return true;
        }
           public function updationUsersInformation($id,$param) {
               
            $this->db->where("userId" ,$id);
         $this->db->update('user_information', $param);
        return true;
           }
            public function updationUsersLocation($id,$param) {
       
          $this->db->where("userid",$id);
         $this->db->update('user_locations', $param);
        return true;
            }
       
    
    function  allUsers()
    {
            $this->db->select('ui.area,ui.subcaste,ms.marital_status_name,ui.merital_status,ui.brothers,ui.sisters,ui.hobbies,e.name as educationName,ui.height,ui.gothram,m.mother_tongue_name,r.religion_name');
            $this->db->select('ui.birthtime,ui.multipleImages,us.featureImage');         
            $this->db->select('ui.profission,ui.salary,ui.motherName,ui.fatherName,ui.motherOcc,ui.fatherOcc');
            $this->db->select('ui.alternateNo,ui.address1,ui.address2,ui.otherDetails');
            $this->db->select('ui.educationId,ui.casteId,c.caste_name,us.id,ui.color,ui.placeofbirth,c.mtongue_id,c.religion_id,us.unique_id,us.username,us.email,us.status,us.mobile,c.caste_name,ui.dateofbirth,ui.gender,ui.groom');
            $this->db->from('users as us');
            $this->db->join('user_information as ui', 'us.id = ui.userId');            
           $this->db->join('castes as c', 'ui.casteId = c.id'); 
            $this->db->join('religion as r', 'c.religion_id = r.id'); 
            $this->db->join('mother_tongue as m', 'c.mtongue_id = m.id'); 
            $this->db->join('education as e', 'ui.educationId = e.id'); 
            $this->db->join('marital_status as ms', 'ui.merital_status = ms.id');   
        
            $query = $this->db->get();
            return $query->result();
    }
        function  singleUser($id)
    {
            $this->db->select('ui.personalDetails,ui.area,ui.subcaste,ms.marital_status_name,ui.merital_status,ui.brothers,ui.sisters,ui.hobbies,e.name as educationName,ui.height,ui.gothram,m.mother_tongue_name,r.religion_name');
            $this->db->select('ui.birthtime,ui.multipleImages,us.featureImage');         
            $this->db->select('ui.profission,ui.salary,ui.motherName,ui.fatherName,ui.motherOcc,ui.fatherOcc,ui.self');
            $this->db->select('ui.alternateNo,ui.address1,ui.address2,ui.otherDetails');
            $this->db->select('ui.educationId,ui.casteId,c.caste_name,us.id,ui.color,ui.placeofbirth,c.mtongue_id,c.religion_id,us.unique_id,us.username,us.email,us.status,us.mobile,c.caste_name,ui.dateofbirth,ui.gender,ui.groom');
            $this->db->from('users as us');
            $this->db->join('user_information as ui', 'us.id = ui.userId');            
           $this->db->join('castes as c', 'ui.casteId = c.id'); 
            $this->db->join('religion as r', 'c.religion_id = r.id'); 
            $this->db->join('mother_tongue as m', 'c.mtongue_id = m.id'); 
            $this->db->join('education as e', 'ui.educationId = e.id'); 
            $this->db->join('marital_status as ms', 'ui.merital_status = ms.id');          
            $this->db->where('us.id='.$id);
            $query = $this->db->get();
            return $query->row_array();
    }

}
