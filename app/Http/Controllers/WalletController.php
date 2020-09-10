<?php

namespace App\Http\Controllers;

use App\Models\User;

class WalletController extends Controller
{
    public function index()
    {
        $user = User::find(1);
        $digitalWalletAry = [
            'name' => 'Digital Wallet',
            'slug' => 'digital-wallet',
            'text' => '數位錢包',
        ];
        $paperWalletAry = [
            'name' => 'Paper Wallet',
            'slug' => 'paper-wallet',
            'text' => '紙本錢包',
        ];
        $digitalWallet = $user->getWallet($digitalWalletAry['slug']);
        if (!$user->hasWallet($digitalWalletAry['slug'])) {
            $digitalWallet = $user->createWallet([
                'name' => $digitalWalletAry['name'],
                'slug' => $digitalWalletAry['slug'],
            ]);
        }
        echo $digitalWalletAry['text'] . '儲值：$400' . PHP_EOL;
        $digitalWallet->deposit(400);
        echo $digitalWalletAry['text'] . '餘額：$' . $digitalWallet->balance . PHP_EOL;
        echo $digitalWalletAry['text'] . '領出：$100' . PHP_EOL;
        $digitalWallet->withdraw(100);
        echo $digitalWalletAry['text'] . '餘額：$' . $digitalWallet->balance . PHP_EOL;
        $paperWallet = $user->getWallet($paperWalletAry['slug']);
        if (!$user->hasWallet($paperWalletAry['slug'])) {
            $paperWallet = $user->createWallet([
                'name' => $paperWalletAry['name'],
                'slug' => $paperWalletAry['slug'],
            ]);
        }
        echo $paperWalletAry['text'] . '餘額：$' . $paperWallet->balance . PHP_EOL;
        echo $digitalWalletAry['text'] . '轉帳到' . $paperWalletAry['text'] . '：$150' . PHP_EOL;
        $digitalWallet->transfer($paperWallet, 150);
        echo $digitalWalletAry['text'] . '餘額：$' . $digitalWallet->balance . PHP_EOL;
        echo $paperWalletAry['text'] . '餘額：$' . $paperWallet->balance . PHP_EOL;
    }
}
