<?php

class UserModel extends CI_Model {
    /*
     * 
     */

    function inserData($data,$uitable) {
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);
        $this->db->insert('users', $data);
        $id = $this->db->insert_id();
        $data1 = array(
            'userId' => $id,
            
        );
        $userinformation = array(
            'userId' => $id,
            'caste' => $uitable['caste'],
            'dateofbirth' => $uitable['dateofbirth']
        );
        
        $location = array(
            'userid' => $id
        );
        $this->db->insert('user_information', $userinformation);
        $this->db->insert('user_family', $data1);
        $this->db->insert('user_locations', $location);
        $this->db->insert('user_partner', $location);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }

    function singleUsers($id) {
        $this->db->select('ui.self,ui.partnerprefer,ui.aboutSelf,uf.aboutSisters,uf.aboutBrothers,ui.star,uf.alternateNo,ui.rashi,ui.area,ui.subcaste,ms.marital_status_name,ui.merital_status,uf.hobbies,ui.height,ui.gothram,m.mother_tongue_name,r.religion_name');
        $this->db->select('ui.birthtime,us.featureImage');
        $this->db->select('pt.age as page,pt.religionId as preligionId,pt.mothertoungeId as pmothertoungeId,pt.location as plocation,pt.education as peducation,pt.otherDetails as potherDetails');
        $this->db->select('ui.profission,ui.salary,uf.motherName,uf.fatherName,uf.motherOcc,uf.fatherOcc');
        $this->db->select('uf.brothers,uf.sisters,uf.address1,uf.otherDetails');
        $this->db->select('ui.educationId,ui.caste,c.caste_name,us.id,ui.color,ui.placeofbirth,c.mtongue_id,c.religion_id,us.unique_id,us.username,us.email,us.status,us.mobile,c.caste_name,ui.dateofbirth,us.gender,ui.groom');
        $this->db->from('users as us');
        $this->db->join('user_information as ui', 'us.id = ui.userId');
        $this->db->join('user_family as uf', 'us.id = uf.userId');    
        $this->db->join('castes as c', 'ui.caste = c.id', "left");
        $this->db->join('religion as r', 'c.religion_id = r.id', "left");
        $this->db->join('mother_tongue as m', 'c.mtongue_id = m.id', "left");           
        $this->db->join('marital_status as ms', 'ui.merital_status = ms.id', "left");
        $this->db->join('user_partner as pt', 'us.id = pt.id', "left");
        $this->db->where('us.id='.$id);        
        $query = $this->db->get();
       return $query->row_array();
       
    }
        function  allUsers()
    {
        $this->db->select('ui.partnerprefer,ui.aboutSelf,uf.aboutSisters,uf.aboutBrothers,ui.star,uf.alternateNo,ui.rashi,ui.area,ui.subcaste,ms.marital_status_name,ui.merital_status,uf.hobbies,ui.height,ui.gothram,m.mother_tongue_name,r.religion_name');
        $this->db->select('ui.birthtime,us.featureImage');
        $this->db->select('ui.profission,ui.salary,uf.motherName,uf.fatherName,uf.motherOcc,uf.fatherOcc');
        $this->db->select('uf.brothers,uf.sisters,uf.address1,uf.otherDetails');
        $this->db->select('ui.educationId,ui.caste,c.caste_name,us.id,ui.color,ui.placeofbirth,c.mtongue_id,c.religion_id,us.unique_id,us.username,us.email,us.status,us.mobile,c.caste_name,ui.dateofbirth,us.gender,ui.groom');
        $this->db->from('users as us');
        $this->db->join('user_information as ui', 'us.id = ui.userId');
        $this->db->join('user_family as uf', 'us.id = uf.userId');
        $this->db->join('castes as c', 'ui.caste = c.id', "left");
        $this->db->join('religion as r', 'c.religion_id = r.id', "left");
        $this->db->join('mother_tongue as m', 'c.mtongue_id = m.id', "left");
        $this->db->join('marital_status as ms', 'ui.merital_status = ms.id', "left"); 
         $this->db->order_by("us.id","desc");
         
        $query = $this->db->get();
        return $query->result();
    }
    function searchMatch($param)
    {
        
        $this->db->select('ui.aboutSelf,uf.aboutSisters,uf.aboutBrothers,ui.star,uf.alternateNo,ui.rashi,ui.area,ui.subcaste,ms.marital_status_name,ui.merital_status,uf.hobbies,ui.height,ui.gothram,m.mother_tongue_name,r.religion_name');
        $this->db->select('ui.birthtime,us.featureImage');
        $this->db->select('ui.profission,ui.salary,uf.motherName,uf.fatherName,uf.motherOcc,uf.fatherOcc');
        $this->db->select('uf.brothers,uf.sisters,uf.address1,uf.otherDetails');
        $this->db->select('ui.educationId,ui.caste,c.caste_name,us.id,ui.color,ui.placeofbirth,c.mtongue_id,c.religion_id,us.unique_id,us.username,us.email,us.status,us.mobile,c.caste_name,ui.dateofbirth,us.gender,ui.groom');
        $this->db->from('users as us');
        $this->db->join('user_information as ui', 'us.id = ui.userId');
        $this->db->join('user_family as uf', 'us.id = uf.userId');
        $this->db->join('castes as c', 'ui.caste = c.id', "left");
        $this->db->join('religion as r', 'c.religion_id = r.id', "left");
        $this->db->join('mother_tongue as m', 'c.mtongue_id = m.id', "left");    
        $this->db->join('marital_status as ms', 'ui.merital_status = ms.id', "left");      
         $this->db->order_by("us.id","DESC");
        $this->db->where('us.gender',$param['gender']);  
            $query = $this->db->get();
            return $query->result();
    }
    
    function shotListUsers($id) {
        $this->db->select('ui.partnerprefer,ui.aboutSelf,uf.aboutSisters,uf.aboutBrothers,ui.star,uf.alternateNo,ui.rashi,ui.area,ui.subcaste,ms.marital_status_name,ui.merital_status,uf.hobbies,ui.height,ui.gothram,m.mother_tongue_name,r.religion_name');
        $this->db->select('ui.birthtime,us.featureImage');
        $this->db->select('ui.profission,ui.salary,uf.motherName,uf.fatherName,uf.motherOcc,uf.fatherOcc');
        $this->db->select('uf.brothers,uf.sisters,uf.address1,uf.otherDetails');
        $this->db->select('ui.educationId,ui.caste,c.caste_name,us.id,ui.color,ui.placeofbirth,c.mtongue_id,c.religion_id,us.unique_id,us.username,us.email,us.status,us.mobile,c.caste_name,ui.dateofbirth,us.gender,ui.groom');
        $this->db->from('users as us');      
        $this->db->join('profile_shortlist as ps', 'us.id = ps.profileId');
        $this->db->join('user_information as ui', 'us.id = ui.userId');
        $this->db->join('user_family as uf', 'us.id = uf.userId');
        $this->db->join('castes as c', 'ui.caste = c.id', "left");
        $this->db->join('religion as r', 'c.religion_id = r.id', "left");
        $this->db->join('mother_tongue as m', 'c.mtongue_id = m.id', "left");      
        $this->db->join('marital_status as ms', 'ui.merital_status = ms.id', "left");     
        $this->db->where('ps.userId',$id);         
         $this->db->order_by("us.id","desc");
        $query = $this->db->get();
       return $query->result();
    }

}
