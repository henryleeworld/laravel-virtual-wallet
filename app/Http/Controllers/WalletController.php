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
        ];
        $paperWalletAry = [
            'name' => 'Paper Wallet',
            'slug' => 'paper-wallet',
        ];
        $digitalWallet = $user->getWallet($digitalWalletAry['slug']);
        if (!$user->hasWallet($digitalWalletAry['slug'])) {
            $digitalWallet = $user->createWallet([
                'name' => $digitalWalletAry['name'],
                'slug' => $digitalWalletAry['slug'],
            ]);
        }
        echo __($digitalWalletAry['name']) . __(' deposits: ') . '$' . ($depositPrice = 400) . PHP_EOL;
        $digitalWallet->deposit($depositPrice);
        echo __($digitalWalletAry['name']) . __(' balance: ') . '$' . $digitalWallet->balance . PHP_EOL;
        echo __($digitalWalletAry['name']) . __(' withdraws: ') . '$' . ($withdrawPrice = 100) . PHP_EOL;
        $digitalWallet->withdraw($withdrawPrice);
        echo __($digitalWalletAry['name']) . __(' balance: ') . '$' . $digitalWallet->balance . PHP_EOL;
        $paperWallet = $user->getWallet($paperWalletAry['slug']);
        if (!$user->hasWallet($paperWalletAry['slug'])) {
            $paperWallet = $user->createWallet([
                'name' => $paperWalletAry['name'],
                'slug' => $paperWalletAry['slug'],
            ]);
        }
        echo __($paperWalletAry['name']) . __(' balance: ') . '$' . $paperWallet->balance . PHP_EOL;
        echo __($digitalWalletAry['name']) . __(' transfers to ') . __($paperWalletAry['name']) . __(': ') . '$' . ($transferPrice = 150) . PHP_EOL;
        $digitalWallet->transfer($paperWallet, $transferPrice);
        echo __($digitalWalletAry['name']) . __(' balance: ') . '$' . $digitalWallet->balance . PHP_EOL;
        echo __($paperWalletAry['name']) . __(' balance: ') . '$' . $paperWallet->balance . PHP_EOL;
    }
}
