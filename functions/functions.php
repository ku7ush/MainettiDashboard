<?php

    function send_email( $text, $subject, $partner) {

        $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml" style="font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
        <head>
        <meta name="viewport" content="width=device-width" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Minton - Responsive Admin Dashboard Template</title>
        
        
        <style type="text/css">
        img {
        max-width: 100%;
        }
        body {
        -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; line-height: 1.6em;
        }
        body {
        background-color: #f6f6f6;
        }
        @media only screen and (max-width: 640px) {
          body {
            padding: 0 !important;
          }
          h1 {
            font-weight: 800 !important; margin: 20px 0 5px !important;
          }
          h2 {
            font-weight: 800 !important; margin: 20px 0 5px !important;
          }
          h3 {
            font-weight: 800 !important; margin: 20px 0 5px !important;
          }
          h4 {
            font-weight: 800 !important; margin: 20px 0 5px !important;
          }
          h1 {
            font-size: 22px !important;
          }
          h2 {
            font-size: 18px !important;
          }
          h3 {
            font-size: 16px !important;
          }
          .container {
            padding: 0 !important; width: 100% !important;
          }
          .content {
            padding: 0 !important;
          }
          .content-wrap {
            padding: 10px !important;
          }
          .invoice {
            width: 100% !important;
          }
        }
        </style>
        </head>
        
        <body itemscope itemtype="http://schema.org/EmailMessage" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; line-height: 1.6em; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6">
        
        <table class="body-wrap" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6"><tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top"></td>
                <td class="container" width="600" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto;" valign="top">
                    <div class="content" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; max-width: 600px; display: block; margin: 0 auto; padding: 20px;">
                        <table class="main" width="100%" cellpadding="0" cellspacing="0" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; border-radius: 3px; background-color: #fff; margin: 0; border: 1px solid #e9e9e9;" bgcolor="#fff"><tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="alert alert-warning" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 16px; vertical-align: top; color: #fff; font-weight: 500; text-align: center; border-radius: 3px 3px 0 0; background-color: #2f353f; margin: 0; padding: 20px;" align="center" bgcolor="#2f353f" valign="top">
                                    Warning: You\'re approaching your limit. Please upgrade.
                                </td>
                            </tr><tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="content-wrap" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 20px;" valign="top">
                                    <table width="100%" cellpadding="0" cellspacing="0" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="content-block" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
                                                You have <strong style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">1 free report</strong> remaining.
                                            </td>
                                        </tr><tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="content-block" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
                                                Add your credit card now to upgrade your account to a premium plan to ensure you don\'t miss out on any reports.
                                            </td>
                                        </tr><tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="content-block" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
                                                <a href="#" class="btn-primary" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; color: #FFF; text-decoration: none; line-height: 2em; font-weight: bold; text-align: center; cursor: pointer; display: inline-block; border-radius: 5px; text-transform: capitalize; background-color: #3bafda; margin: 0; border-color: #3bafda; border-style: solid; border-width: 10px 20px;">Upgrade my account</a>
                                            </td>
                                        </tr><tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="content-block" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top">
                                                Thanks for choosing Minton Admin.
                                            </td>
                                        </tr></table></td>
                            </tr></table><div class="footer" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; clear: both; color: #999; margin: 0; padding: 20px;">
                            <table width="100%" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="aligncenter content-block" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 12px; vertical-align: top; color: #999; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top"><a href="#" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 12px; color: #999; text-decoration: underline; margin: 0;">Unsubscribe</a> from these alerts.</td>
                                </tr></table></div></div>
                </td>
                <td style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top"></td>
            </tr></table></body>
        </html>';

        $header = "To: <vinset1985@gmail.com>\n";
        $header .= "From: EffeTrade <store@effetrade.it>\n";
        $header .= "X-Mailer: Il nostro Php\n\n";
        $oggetto = "oggetto del messaggio";
        $messaggio = "testo del messaggio vero e proprio";
        mail( "vinset1985@gmail.com",$oggetto,$messaggio,$header);

    }

	function getOrdersNumber($idU, $db, $agentID) {

        $ids = array();

        if($agentID != null) {

            $db->where( "agent_id", $agentID );

            $db->where( "agent", 0 );

            $results = $db->get("partners", null, "id");

            foreach ($results as $key => $id) {

                $ids[$key] = $id['id'];

            }
            
        } else {

            $ids[0] = $idU;

        }
		
		    $db->where( "partner_id", $ids, 'in' );
		
            $count			=			$db->getValue ("orders", "count(*)");
        
		return	$count;
		
    }
    
    function getTicketsNumber($id, $db) {
		
        $db->where( "user_id", $id );
        
        $db->where( "parent", 0 );

        $db->where( "status", 0 );
		
		$count			=			$db->getValue ("tickets", "count(*)");
		
		return	$count;
		
	}
    
    function getTicketsAdminNumber($id, $db, $status){
        
        $db->where( "user_id", $id );

        $categories =   $db->get("partners_acl", null, 'category_id');

        $categs = array();

        foreach($categories as $key => $cat) {

            $categs[$key] = $cat['category_id'];

        }    

        $db->where ('category', $categs, 'in');

        $db->where( "parent", 0 );

        if ($status === 0) {

            $db->where( "status", 0 );

        }

		
		$count			=			$db->getValue ("tickets", "count(*)");
		
        return	$count;
        
    }

	function getOrdersTypeNum($idU, $type, $week, $db, $agentID) {

        $ids = array();

        if($agentID != null) {

            $db->where( "agent_id", $agentID );

            $db->where( "agent", 0 );

            $results = $db->get("partners", null, "id");

            foreach ($results as $key => $id) {

                $ids[$key] = $id['id'];

            }
            
        } else {

            $ids[0] = $idU;

        }

            $db->where( "partner_id", $ids, 'in' );
            
            $db->where( "state", $type );
            
            if($week == true) {
                
                $date		=		date('Y-m-d', strtotime('-7 days', strtotime('today')));
                
                $db->where( "date", $date, ">=" );
                
            }
            
            $count		=		$db->getValue ("orders", "count(*)");
		
		return	$count;
		
	}
	
	function getOrders($idU, $db, $agentID) {

        $ids = array();

        if($agentID != null) {

            $db->where( "agent_id", $agentID );

            $db->where( "agent", 0 );

            $results = $db->get("partners", null, "id");

            foreach ($results as $key => $id) {

                $ids[$key] = $id['id'];

            }

            //$db->where('state', Array(1, 2), 'in');
            
        } else {

            $ids[0] = $idU;

        }

        $db->join("address a", "a.id=o.address_id", "LEFT");

        $db->where( "o.partner_id", $ids, 'in' );
		
		$db->orderBy("o.id","desc");
		
		$orders		=	$db->get("orders o", null, "o.*, a.societa, a.nome, a.nazione, a.via, a.edificio, a.frazione, a.citta, a.cap, a.provincia, a.telefono");
		
		return	$orders;
		
	}
	
	function deleteOrder($id, $db) {
		
		$db->where( "id", $id );
		
		if($db->delete('orders')) {
			
			return	1;
		
		} else {
			
			return	0;
			
		}
		
	}
	
	function getProductsOrder($order_id, $db) {

		$db->join("products p", "p.id=l.product_id", "LEFT");
		
		$db->where( "l.order_id", $order_id );
		
		$db->orderBy("l.id","desc");
		
		$prodOrd		=		$db->get("lines_product l", null, "l.*, p.price_unit price");
		
		return	$prodOrd;
		
	}
	
	function getProductName($id, $db) {
		
		$db->where( "id", $id );
		
		$name		=			$db->getValue("products", "name");
		
		return	$name;
		
	}
	
	function getProductColor($id, $db) {

        //$db->join("product_variants a", "a.odoo_id=o.variant_id", "LEFT");

		//$db->where("o.product_id", $id);

		//$color		=		$db->getValue("product_basecolor o", "a.description");
		
		$db->where( "odoo_id", $id );
		
		$color		=			$db->getValue("product_variants", "description");
		
		return	$color;
		
	}
	
	function getProductNet($id, $db) {
		
		$db->where( "odoo_id", $id );
		
		$net		=			$db->getValue("product_variants", "description");
		
		return	$net;
		
	}
	
	function getDocNum($type, $id, $db) {
		
		$db->where( "id", $id );
		
		$vat		=			$db->getValue("partners", "username");
	
		$directory = '../../users/'.$vat.'/'.$type.'/';
  		
  		if(glob($directory . "*.pdf") != false) {
  				
  			$filecount = count(glob($directory . "*.pdf"));
  				
  		} else {
  			
  			$filecount = 0;
  			
  		}
  		
  		return $filecount;
	
	}
	
	function getTotal($idU, $date, $db, $agentID) {

        $ids = array();

        if($agentID != null) {

            $db->where( "agent_id", $agentID );

            $db->where( "agent", 0 );

            $results = $db->get("partners", null, "id");

            foreach ($results as $key => $id) {

                $ids[$key] = $id['id'];

            }
            
        } else {

            $ids[0] = $idU;

        }
		
		if($date == 'day') {
			
			$start = date('Y-m-d', strtotime('today'));
			
		}
		
		if($date == 'week') {
			
			$start = date('Y-m-d', strtotime('-7 days', strtotime('today')));
			
		}
		
		if($date == 'month') {
			
			$start = date('Y-m-d', strtotime('-30 days', strtotime('today')));
			
        }
        
        $db->where( "partner_id", $ids, 'in' );
		
		$db->where( "date", $start, ">=" );		
		
		$db->where('state', Array(1, 2), 'in');

		$totals		=		$db->get("orders", null, "total");
		
		$sum = 0;
		
		foreach ($totals as $total) {
		
		$sum = $sum + $total['total'];
		
		}
		
		return $sum;
		
    }
    
	
	function getTotalsMonth($idU, $db, $agentID) {

        $ids = array();

        if($agentID != null) {

            $db->where( "agent_id", $agentID );

            $db->where( "agent", 0 );

            $results = $db->get("partners", null, "id");

            foreach ($results as $key => $id) {

                $ids[$key] = $id['id'];

            }
            
        } else {

            $ids[0] = $idU;

        }

		$db->where( "partner_id", $ids, 'in' );

		$start = date('Y-m-d', strtotime('-30 days', strtotime('today')));

		$db->where( "date", $start, ">=" );		
		
		$db->where('state', Array(1, 2), 'in');

        $totals		=	$db->get("orders", null, "total");
        
        
		
		return $totals;
		
    }

    
    function getTicketForDay ($id, $db) {

        $db->where( "user_id", $id );

        $categories =   $db->get("partners_acl", null, 'category_id');

        $categs = array();

        foreach($categories as $key => $cat) {

            $categs[$key] = $cat['category_id'];

        }    

        $db->where ('category', $categs, 'in');

        $db->where( "parent", 0 );

        $db->groupBy ("DAY(date)");

        $tickets    =   $db->get("tickets", null, "count(*) count");

        return $tickets;

    }

    function getTotalTicket($id, $date, $db) {

        $db->where( "user_id", $id );

        $categories =   $db->get("partners_acl", null, 'category_id');

        $categs = array();

        foreach($categories as $key => $cat) {

            $categs[$key] = $cat['category_id'];

        }    

        $db->where ('category', $categs, 'in');

        $db->where( "parent", 0 );
		
		if($date == 'day') {
			
			$start = date('Y-m-d', strtotime('today'));
			
		}
		
		if($date == 'week') {
			
			$start = date('Y-m-d', strtotime('-7 days', strtotime('today')));
			
		}
		
		if($date == 'month') {
			
			$start = date('Y-m-d', strtotime('-30 days', strtotime('today')));
			
		}
		
		$db->where( "date", DATE($start), ">=" );		

		$totals		=		$db->getValue("tickets", "count(*)");
		
		
		return $totals;
		
	}
        
    function getAddress($idU, $db) {

        $db->where( "partner_id", $idU );

        $address		=	$db->get("address");
		
		return	$address;

    }

?>