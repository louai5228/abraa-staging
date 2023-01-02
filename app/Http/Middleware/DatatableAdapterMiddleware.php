<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DatatableAdapterMiddleware
{


    public function addFilters(&$request)
    {
        $i = 0 ;
        $filters = $request->get('filter');
        $columns = [];
        foreach (array_keys($filters) as $key){
            $columns[$i]['data'] = $key;
            $columns[$i]['name'] = '';
            $columns[$i]['searchable'] = true;
            $columns[$i]['orderable'] = true;
            $columns[$i]['search']['value'] = $filters[$key];
            $columns[$i]['search']['regex'] = false;
            $i++;
        }
        $request->query->add(['columns' => $columns]);
    }
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->has('filter')){
            $this->addFilters($request);
        }
        $start = null;
        if ($request->has('datatables') && $request->datatables && $request->has('limit') && $request->has('page')) {

            $start = $request->get('limit') * ($request->get('page') - 1);

            $request->query->add(['length' => $request->get('limit'), 'start' => $start]);

            $response = $next($request);

            /** @var JsonResponse $response */
            $content = json_decode($response->content(), true);
            if(isset($content))
            if($content['data'] !=null){
                $content['data']['original'] = array_merge($content['data']['original'], [
                    'pagination' => [
                        'total' => $content['data']['original']['recordsFiltered'],
                        'limit' => $content['data']['original']['input']['length'],
                        'total_pages' => floor(($content['data']['original']['recordsFiltered'] + $content['data']['original']['input']['limit'] - 1) / $content['data']['original']['input']['limit']),
                        'current_page' => $content['data']['original']['input']['start'] / $content['data']['original']['input']['limit'] + 1],
                ]);
                $response->setContent(json_encode($content));
                $response->setJson(json_encode($content));
                $response->setData($content);
            }
                return $response;

        } else {
            return $next($request);
        }
    }
}
