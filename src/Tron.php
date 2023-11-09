<?php

namespace MHamid\i3erver;

class Tron extends Client {

    public Function GetAmount($address) {
        $get = file_get_contents("https://apilist.tronscanapi.com/api/account/tokens?address=".$address."&start=0&limit=20&token=&hidden=0&show=0&sortType=0&sortBy=0");
        if ( isset(json_decode($get)->message) ) {
            return false;
        }
        return json_decode($get)->data[0]->amount;
    }

    public Function RecentTransactions($address) {
        $get = file_get_contents("https://apilist.tronscanapi.com/api/transaction?sort=-timestamp&count=true&limit=20&start=0&address=".$address);
        $result = json_decode($get , true);
        if ( isset($result['message']) ) {
            return false;
        }
        foreach ($result['data'] as $data) {
            $datas[] = [
                'result' => $data['result'],
                'hash' => $data['hash'],
                'ownerAddress' => $data['ownerAddress'],
                'toAddress' => $data['toAddress'],
                'contractData' => [
                    'amount' => $data['contractData']['amount'],
                    'owner_address' => $data['contractData']['owner_address'],
                    'to_address' => $data['contractData']['to_address']
                ]
            ];
        }
        return json_encode([
            'status' => true,
            'result' => $datas
        ],448);
    }

    Function CheckContract($w) {
        $get = file_get_contents("https://apilist.tronscanapi.com/api/contract?contract=$w&type=contract");
        $res = json_decode($get , true);
    
        if ( $res['status']['message'] == "SUCCESS" and isset($res['data'][0]['name']) ) {
            return true;
        } else {
            return false;
        }
    }
    
}