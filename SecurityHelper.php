<?php 

class SecurityHelper 
{
	
    public function cfban($ipaddr){ 

        $cfheaders = array(
            'Content-Type: application/json',
            'X-Auth-Email: '.env('CF_EMAIL'),
            'X-Auth-Key: '.env('CF_KEY')
        );
        $data = array(
            'mode' => 'block',
            'configuration' => array('target' => 'ip', 'value' => $ipaddr),
            'notes' => 'Banned on '.date('Y-m-d H:i:s').' by Nafezly.com Firewall'
        );
        $json = json_encode($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $cfheaders);
        curl_setopt($ch, CURLOPT_URL, 'https://api.cloudflare.com/client/v4/user/firewall/access_rules/rules');
        $return = curl_exec($ch);
        curl_close($ch);

        if ($return === false){
            return false;
        }else{
            $return = json_decode($return,true);
            if(isset($return['success']) && $return['success'] == true){
                return True;
            }else{
                return false;
            }
        }

    }

    public function cfunban($block_rule_id){
    
        $cfheaders = array(
            'Content-Type: application/json',
            'X-Auth-Email: '.env('CF_EMAIL'),
            'X-Auth-Key: '.env('CF_KEY')
        ); 
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $cfheaders);
        curl_setopt($ch, CURLOPT_URL, 'https://api.cloudflare.com/client/v4/user/firewall/access_rules/rules/'.$block_rule_id); 
        $return = curl_exec($ch);  
        if ($return === false){
            return false;
        }else{ 
            $return = json_decode($return,true);
            if(isset($return['success']) && $return['success'] == true){
                return  True; 
            }else{
                return false;
            }
        }

    }

    public function blockIp($ip)
    {
        return $this->cfban($ip);
    }
     public function unBlockIp($state_id)
    {
        return $this->cfunban($state_id);
    }
}