<?php

namespace App\Http;

trait Response
{
    /**
	 * 成功提示
	 * 
	 * @param  string  $message  提示信息
     * @param  array   $data     附带数据
	 * @return \Illuminate\Http\Response
	 */
	protected function success(string $message, array $data = [])
	{
		return response()->json(['message' => $message, 'data' => $data]);
	}

	/**
	 * 错误提示
	 * 
	 * @param  string  $message  提示信息
     * @param  array   $data     附带数据
     * @param  int     $code     状态码
	 * @return \Illuminate\Http\Response|Illuminate\Http\RedirectResponse
	 */
	protected function error(string $message, array $data = [], int $code = 400)
	{
		if (request()->ajax()) {
			return response()->json(['message' => $message, 'data' => $data], $code);
		} else {
			return redirect(url('error'))->with('error', compact('message', 'data', 'code'));
		}
    }
}