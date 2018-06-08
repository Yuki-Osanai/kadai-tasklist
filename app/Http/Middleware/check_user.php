<?php

namespace App\Http\Middleware;

use Closure;

class check_user
{
    /**
     * 送信されてきたリクエストの処理
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->id == $task->user_id) {
            return redirect('tasks.index');
        }

        return $next($request);
    }

}