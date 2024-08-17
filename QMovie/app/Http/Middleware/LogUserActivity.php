<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use GuzzleHttp\Client;

class LogUserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        $this->logActivity($request);

        return $response;
    }

    private function logActivity(Request $request)
    {
        if (Auth::check()) {
            Activity::create([
                'log_name' => 'user',
                'description' => 'User accessed page',
                'subject_type' => get_class(Auth::user()),
                'subject_id' => Auth::id(),
                'properties' => [
                    'browser' => $this->getBrowserName($request->header('User-Agent')),
                    'ip_address' => $request->ip(),
                    'device' => $this->getDeviceType(),
                    'os' => $this->getOperatingSystem(),
                    'country' => $this->getCountry($request->ip()),
                    'log' => $request->path(),
                    'last_accessed' => now(),
                    'total_pages_accessed' => $this->getTotalPagesAccessed(),
                ],
            ]);
        } else {
            Activity::create([
                'log_name' => 'guest',
                'description' => 'Guest accessed page',
                'properties' => [
                    'browser' => $this->getBrowserName($request->header('User-Agent')),
                    'ip_address' => $request->ip(),
                    'device' => $this->getDeviceType(),
                    'os' => $this->getOperatingSystem(),
                    'country' => $this->getCountry($request->ip()),
                    'log' => $request->path(),
                    'last_accessed' => now(),
                    'total_pages_accessed' => $this->getTotalPagesAccessed(),
                ],
            ]);
        }
    }

    private function getDeviceType()
    {
        $agent = new Agent();

        if ($agent->isDesktop()) {
            return 'Desktop';
        } elseif ($agent->isTablet()) {
            return 'Tablet';
        } elseif ($agent->isMobile()) {
            return 'Mobile';
        } else {
            return 'Unknown';
        }
    }

    private function getOperatingSystem()
    {
        $agent = new Agent();
        return $agent->platform(); // Trả về tên hệ điều hành (vd: 'Windows', 'iOS', 'Android', v.v.)
    }

    private function getBrowserName($userAgent)
    {
        $agent = new Agent();
        $agent->setUserAgent($userAgent);

        return $agent->browser(); // Trả về tên trình duyệt (vd: 'Chrome', 'Safari', 'Firefox', v.v.)
    }

    private function getCountry($ip)
    {
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) === false) {
            return 'Localhost';
        }

        $client = new Client();
        $response = $client->get("http://ipinfo.io/{$ip}/country");

        if ($response->getStatusCode() == 200) {
            return trim($response->getBody()->getContents()); // Trả về mã quốc gia (vd: 'US', 'VN')
        }

        return 'Unknown';
    }

    private function getTotalPagesAccessed()
    {
        $pagesAccessed = session()->get('pages_accessed', 0);
        $pagesAccessed += 1;
        session()->put('pages_accessed', $pagesAccessed);
        return $pagesAccessed;
    }
}
