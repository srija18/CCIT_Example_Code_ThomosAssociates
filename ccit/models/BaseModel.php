<?php

class BaseModel extends CI_Model {
    /*
     * 
     */
        public function __construct() {
        parent::__construct();
        $this->db->query("SET time_zone='+05:30'");
      
        
    }

    private function SelectQH($columns = '') {
        /* select columns / field data from table */
        $select = '';
        if (!empty($columns)) {
            if (is_array($columns)) {
                $select = implode(', ', $columns);
            } else {
                $select = $columns;
            }
        } else {
            $select = '*';
        }
        return $this->db->select($select);
    }

    private function whereQH($where = '') {
        /* where conditons to retrive data */
        $conditions = '';
        if (!empty($where)) {
            if (is_array($where)) {
                $conditions = $where;
            } else {
                $con = array_filter(explode(',', $where));
                foreach ($con as $value) {
                    $whr = '';
                    $whr = explode(':', $value);
                    $conditions[$whr[0]] = $whr[1];
                }
            }
            return $this->db->where($conditions);
        } else {
            return '';
        }
    }
    
    private function whereInQH($where = '') {
        /* where conditons to retrive data */
        $conditions = '';
        if (!empty($where)) {
            $where = explode(':', $where);
            return $this->db->where_in($where[0], $where[1]);
        } else {
            return '';
        }
    }

    private function groupByQH($group = '') {
        /* group selection based on column */
        $groupBy = '';
        if (!empty($group)) {
            if (is_array($group)) {
                $groupBy = $group;
            } else {
                $grp = explode(',', $group);
                $groupBy = array_filter($grp);
            }
            return $this->db->group_by($groupBy);
        } else {
            return '';
        }
    }

    private function orderByHQ($order = '') {
        /* order selection based on column */
        $orderBy = '';
        if (!empty($order)) {
            if (is_array($order)) {
                foreach ($order as $key => $val) {
                    $orderBy .= $key . ' ' . $val . ',';
                }
                $orderBy = rtrim($orderBy, ',');
            } else {
                $orderBy = str_replace(':', ' ', $order);
            }
            return $this->db->order_by($orderBy);
        } else {
            return '';
        }
    }

    private function limitHQ($limit = '') {
        /* limit of records to be feached */
        $limitTo = '';
        if (!empty($limit)) {
            if ($limit != 'All') {
                if (strpos($limit, ':') !== false) {
                    $limitTo = str_replace(':', ', ', $limit);
                } else {
                    $limitTo = $limit;
                }
            } else {
                $limitTo = '';
            }
        } else {
            $limitTo = '20';
        }
        return $limitTo;
    }

    function featchData($table, $columns = '', $where = '', $group = '', $order = '', $limit = '') {
        if (!empty($table)) {
            $this->SelectQH($columns);
            $this->whereQH($where);
            $this->groupByQH($group);
            $this->orderByHQ($order);
            $limitTo = $this->limitHQ($limit);
            if (!empty($limitTo)) {
                $this->db->limit($limitTo);
            }
            $query = $this->db->get($table);
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    function featchRow($table, $columns = '', $where = '', $group = '', $order = '') {
        if (!empty($table)) {
            $this->SelectQH($columns);
            $this->whereQH($where);
            $this->groupByQH($group);
            $this->orderByHQ($order);
            $query = $this->db->get($table);
            if ($query->num_rows() > 0) {
                return $query->row();
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    function featchSingleField($table, $columns = '', $where = '', $group = '', $order = '', $limit = '') {
        if (!empty($table)) {
            $this->db->select($columns);
            $this->whereQH($where);
            $this->groupByQH($group);
            $this->orderByHQ($order);
            $limitTo = $this->limitHQ($limit);
            if (!empty($limitTo)) {
                $this->db->limit($limitTo);
            }
            $query = $this->db->get($table);
            if ($query->num_rows() > 0) {
                return $query->row($columns);
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }
    
    function featchCountOfRows($table, $where = '') {
        if (!empty($table)) {
            $this->db->select('*');
            $this->whereQH($where);
            $query = $this->db->get($table);
            if ($query->num_rows() > 0) {
                return $query->num_rows();
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    private function prefixingKey($array, $prefix) {
        $result = array();
        foreach ($array as $key => $value) {
            $result[$prefix . '.' . $key] = $value;
        }
        return $result;
    }

    private function prefixingValue($array, $prefix) {
        $result = array();
        foreach ($array as $key => $value) {
            $result[$key] = $prefix . '.' . $value;
        }
        return $result;
    }

    function featchJoinResult($tabels, $join, $joinType = '', $TAcolumns = '', $TBcolumns = '', $TAwhere = '', $TBwhere = '', $group = '', $order = '', $limit = '') {
        $tbls = explode(':', $tabels);
        $tableA = $tbls[0];
        $tableB = $tbls[1];

        /* select columns / field data from table */
        $select = '';
        if (!empty($TAcolumns)) {
            $selecta = '';
            if (is_array($TAcolumns)) {
                foreach ($TAcolumns as &$value) {
                    $selecta .= $tableA . '.' . $value . ',';
                }
            } else {
                $sel = array_filter(explode(',', $TAcolumns));
                foreach ($sel as &$value) {
                    $selecta .= $tableA . '.' . $value . ',';
                }
            }
            $selecta = rtrim($selecta, ',');
        } else {
            $selecta = '';
        }
        if (!empty($TBcolumns)) {
            $selectb = ',';
            if (is_array($TBcolumns)) {
                foreach ($TBcolumns as &$value) {
                    $selectb .= $tableB . '.' . $value . ',';
                }
            } else {
                $sel = array_filter(explode(',', $TBcolumns));
                foreach ($sel as &$value) {
                    $selectb .= $tableB . '.' . $value . ',';
                }
            }
            $selectb = rtrim($selectb, ',');
        } else {
            $selectb .= '';
        }
        $select = $selecta . $selectb;
        $this->db->select($select);
        $this->db->from($tableA);
        /* join two tables based on */
        $joinCon = '';
        $joinCol = explode(':', $join);
        $joinCon = $tableB . '.' . $joinCol[0] . ' = ' . $tableA . '.' . $joinCol[1];
        if (!empty($joinType)) {
            $this->db->join($tableB, $joinCon, $joinType);
        } else {
            $this->db->join($tableB, $joinCon);
        }
        /* where conditons to retrive data */
        $conditions = '';
        if (!empty($TAwhere)) {
            if (is_array($TAwhere)) {
                $conditionsA = $this->prefixingKey($TAwhere, $tableA);
            } else {
                $con = array_filter(explode(',', $TAwhere));
                foreach ($con as $value) {
                    $whr = '';
                    $whr = explode(':', $value);
                    $whr = array_filter($whr);
                    $conditionsA[$tableA . '.' . $whr[0]] = $whr[1];
                }
            }
            $this->db->where($conditionsA);
        }
        if (!empty($TBwhere)) {
            if (is_array($TBwhere)) {
                $conditionsB = $this->prefixingKey($TBwhere, $tableB);
            } else {
                $con = array_filter(explode(',', $TBwhere));
                foreach ($con as $value) {
                    $whr = '';
                    $whr = explode(':', $value);
                    $whr = array_filter($whr);
                    $conditionsB[$tableB . '.' . $whr[0]] = $whr[1];
                }
            }
            $this->db->where($conditionsB);
        }
        /* group selection based on column */
        $groupBy = '';
        if (!empty($group)) {
            $grp = explode(':', $group);
            if (!empty($grp[0])) {
                $gpA = array_filter(explode(',', $grp[0]));
                $groupByA = $this->prefixingKey($gpA, $tableA);
            }
            if (!empty($grp[1])) {
                $gpB = array_filter(explode(',', $grp[1]));
                $groupByB = $this->prefixingKey($gpB, $tableB);
            }
            $groupBy = $groupByA + $groupByB;
            $this->db->group_by($groupBy);
        }
        /* order selection based on column */
        $orderBy = '';
        if (!empty($order)) {
            $ord = explode('|', $order);
            if (!empty($ord[0])) {
                $ordA = array_filter(explode(',', $ord[0]));
                $ordByA = implode(',', $this->prefixingValue($ordA, $tableA));
                $orderByA = str_replace(':', ' ', $ordByA);
            } else {
                $orderByA = '';
            }
            if (!empty($ord[1])) {
                $ordB = array_filter(explode(',', $ord[1]));
                $ordByB = implode(',', $this->prefixingValue($ordB, $tableB));
                $orderByB = str_replace(':', ' ', $ordByB);
            } else {
                $orderByB = '';
            }
            $orderBy = trim(($orderByA . ', ' . $orderByB), ', ');
            $this->db->order_by($orderBy);
        }
        $limitTo = $this->limitHQ($limit);
        if (!empty($limitTo)) {
            $this->db->limit($limitTo);
        }
        $query = $this->db->get();
        if ($query->num_rows()) {
            return $query->result();
        } else {
            return FALSE;
        }
    }

    function inserData($table, $param) {
        if (!empty($table)) {
            if (is_array($param)) {
                if (array_key_exists(0, $param)) {
                    $result = $this->db->insert_batch($table, $param);
                } else {
                    $result = $this->db->insert($table, $param);
                }
                if ($result) {
                    return TRUE;
                } else {
                    return FALSE;
                }
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    function updateData($table, $param, $where = '') {
        if (!empty($table)) {            
            if (is_array($param)) {
                if (array_key_exists(0, $param)) {
                    $result = $this->db->update_batch($table, $param, $where);
                } else {
                    $this->whereQH($where);
                    $result = $this->db->update($table, $param);
                }
                if ($result) {
                    return TRUE;
                } else {
                    return FALSE;
                }
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }
    
    function featchDataIn($table, $columns = '', $whereIn = '', $where = '', $order = '', $limit = '') {
        if (!empty($table)) {
            $this->SelectQH($columns);
            $this->whereInQH($whereIn);
            $this->whereQH($where);
            $this->orderByHQ($order);
            $limitTo = $this->limitHQ($limit);
            if (!empty($limitTo)) {
                $this->db->limit($limitTo);
            }
            $query = $this->db->get($table);
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    function metaTags() {
        $meta = array(
            array(
                'name' => 'viewport',
                'content' => 'width=device-width, initial-scale=1.0'
            ),
            array(
                'name' => 'keywords',
                'content' => 'Local Searcher, Local Search, Find Needs, Find Business'
            ),
            array(
                'name' => 'description',
                'content' => 'Local Searcher is local needs finder. '
            ),
            array(
                'name' => 'author',
                'content' => 'Akurathi Anand Kumar'
            ),
            array(
                'name' => 'organisation',
                'content' => 'Abhi Tech Soft'
            )
        );
        return meta($meta);
    }

    function formCssLinks($links = '') {
        $cssLink = '';
        if (!empty($links)) {
            foreach ($links as $value) {
                $cssLink .= link_tag($value);
            }
        } else {
            $cssLink = '';
        }
        return $cssLink;
    }

    function basicCss() {
        $links = array(
            'assets/css/bootstrap.min.css',
            'assets/css/font-awesome.min.css'
        );
        return $this->formCssLinks($links);
    }

    function cssLinks() {
        $links = array(
            'assets/css/bootstrap.min.css',
            'assets/css/sb-admin.css',
            'assets/css/font-awesome.min.css',
            'assets/css/style.css'
        );
        return $this->formCssLinks($links);
    }

    function formingJsLink($links) {
        $js = '';
        if (!empty($links)) {
            foreach ($links as $value) {
                $js .= '<script src="' . base_url($value) . '" type="test/javascript"></script>';
            }
        } else {
            $js = '';
        }
        return $js;
    }

    function setuDetails($email) {
        $this->db->select('s.*');
        $this->db->from('setup s');
        $this->db->join('setup_config c', 'c.setId = s.id');
        $this->db->where('u.email', $email);
        $this->db->where('u.email', $email);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            echo $this->db->last_query();
            print_r($query->result());
        } else {
            echo $this->db->last_query();
        }
    }

}
