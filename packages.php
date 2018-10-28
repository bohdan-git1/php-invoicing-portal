<?

  
   


function getAccount() {

        $params = array(new xmlrpcval(array("i_account"      => new xmlrpcval($_SESSION['i_account'], "int")), 'struct'));
        $msg = new xmlrpcmsg('getAccountInfo', $params);

        $cli = new xmlrpc_client('https://login.fasttalks.com/xmlapi/xmlapi');
        $cli->setSSLVerifyPeer(false);
        $cli->setCredentials(XML_LOGIN, XML_PASWORD, CURLAUTH_DIGEST);

        $r = $cli->send($msg, 20);       /* 20 seconds timeout */

        if ($r->faultCode()) {
                /* $re "Fault. Code: " . $r->faultCode() . ", Reason: " . $r->faultString(); */
                $error = $r->faultString();
                return false;
        }

        $success_fetch = $r->value();

        $first_name_s  = $success_fetch->structMem('first_name');
        $first_name = $first_name_s->scalarVal();

        $last_name_s  = $success_fetch->structMem('last_name');
        $last_name = $last_name_s->scalarVal();

        $email_s  = $success_fetch->structMem('email');
        $email = $email_s->scalarVal();

        $i_time_zone_s  = $success_fetch->structMem('i_time_zone');
        $i_time_zone = $i_time_zone_s->scalarVal();

        $company_name_s  = $success_fetch->structMem('company_name');
        $company_name = $company_name_s->scalarVal();

        $street_addr_s  = $success_fetch->structMem('street_addr');
        $street_addr = $street_addr_s->scalarVal();

        $phone_s  = $success_fetch->structMem('phone');
        $phone = $phone_s->scalarVal();

        $params = array(new xmlrpcval(array("i_account"      => new xmlrpcval($_SESSION['i_account'], "int")), 'struct'));
        $msg = new xmlrpcmsg('getAccountMinutePlans', $params);

        $ret = array(   'first_name' => $first_name,
                        'last_name' => $last_name,
                        'email' => $email,
                        'i_time_zone' => $i_time_zone,
                        'company_name' => $company_name,
                        'street_addr' => $street_addr,
                        'phone' => $phone
                );
        $cli = new xmlrpc_client('https://login.fasttalks.com/xmlapi/xmlapi');
        $cli->setSSLVerifyPeer(false);
        $cli->setCredentials(XML_LOGIN, XML_PASWORD, CURLAUTH_DIGEST);

        $r = $cli->send($msg, 20);       /* 20 seconds timeout */

        if ($r->faultCode()) {
                /* $re "Fault. Code: " . $r->faultCode() . ", Reason: " . $r->faultString(); */
                $error = $r->faultString();
                return false;
        }

        $success_fetch = $r->value();

        $minute_plans_s  = $success_fetch->structMem('minute_plans');
        $minute_plans = $minute_plans_s->scalarVal();

        if(count($minute_plans)) {
                $minute_plans = $minute_plans[0];

                $seconds_total_s = $minute_plans->structMem('seconds_total');
                $seconds_total = $seconds_total_s->scalarVal();

                $seconds_left_s = $minute_plans->structMem('seconds_left');
                $seconds_left = $seconds_left_s->scalarVal();

                $chargeable_seconds_s = $minute_plans->structMem('chargeable_seconds');
                $chargeable_seconds = $chargeable_seconds_s->scalarVal();

                $ret['seconds_total'] = $seconds_total;
                $ret['seconds_left'] = $seconds_left;
                $ret['chargeable_seconds'] = $chargeable_seconds;

        }

        return $ret;
}

?>
