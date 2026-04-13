<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Agent\Agent;
use Carbon\Carbon;

class Session extends Model
{

    /**
     * The attribute that is auto-increment.
     */
    protected $guarded = ['id'];

    /**
     * The attribute that is ID.
     */
    protected $keyType= 'string';

    /**
     * The additional attributes.
     */
    protected  $appends= [
        'platform', 'browser', 'device', 'platform_icon',
        'agent', 'minutes', 'activity', 'browser_icon', 
        'device_icon'
    ];

    /**
     * Avoid timestamps attributes.
     */
    public $timestamps= false;

    /**
     * Avoid auto-increment ID.
     */
    public $incrementing= false;    

    /*----------------------------------------------------------------------------------------------------------------
    | RELATIONSHIPS
    |----------------------------------------------------------------------------------------------------------------*/
    /* Each Session belongs to [1]User */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /*----------------------------------------------------------------------------------------------------------------
    | GETTERS AND SETTERS
    |----------------------------------------------------------------------------------------------------------------*/
    /**
    * Get Session Agent
    * @return Agent
    */
    public function getAgentAttribute(){

        return new Agent(null, $this->user_agent);
    }

    /**
    * Get Session browser and version
    * @return string
    */
    public function getBrowserAttribute(){
        $browser= $this->agent->browser();
        $version= preg_replace("/(\.|_)./", "", $this->agent->version($browser));
        $version= str_split($version, 2)[0];

        return "{$browser} {$version}";
    }

    /**
    * Get Session browser and version device
    * @return string
    */
    public function getPlatformAttribute(){
        $platform= $this->agent->platform();
        $version= preg_replace("/(\.|_)./", "", $this->agent->version($platform));
        $version= str_split($version, 2)[0];

        return "{$platform} {$version}";
    }

    /**
    * Get Session device Type
    * @return string
    */
    public function getDeviceAttribute(){
        $device= $this->agent->deviceType();
        switch($device){
            case "desktop": $device= 'Computador'; break;
            case "phone": $device= 'Telemovel'; break;
            case "tablet": $device= 'Tablet'; break;
            case "robot": $device= 'Robot';break;
            default: $device= 'Outro';break;
        }
        return $device;
    }

    /**
    * Check weather this session happen between 0-15 minutes.
    * @return boolean
    */
    public function getMinutesAttribute(){
        $lastActivity= Carbon::createFromTimestamp($this->last_activity);

        return $lastActivity->diffInMinutes(now());
    }

    /**
    * Get Plataform icon
    * @return string
    */
    public function getPlatformIconAttribute(){
        $os= $this->agent->platform();
        $icon= '';
        switch($os){
            case "iOS": $icon= 'fab fa-apple'; break;
            case "OS X": $icon= 'fab fa-apple'; break;
            case "Macintosh": $icon= 'fab fa-apple'; break;
            case "AndroidOS": $icon= 'fab fa-android';break;
            case "Windows": $icon= 'fab fa-windows';break;
            case "Windows NT": $icon= 'fab fa-windows';break;
            case "Linux": $icon= 'fab fa-linux';break;
            case "Ubuntu": $icon= 'fab fa-linux';break;
            case "OpenBSD": $icon= 'fab fa-freebsd';break;
            case "BlackBerryOS": $icon= 'fab fa-blackberry';break;
            case "ChromeOS": $icon= 'fab fa-chrome';break;
            default: ;
        }
        return $icon;
    }

        /**
    * Get Plataform icon
    * @return string
    */
    public function getDeviceIconAttribute(){
        $device= $this->agent->deviceType();
        $icon= '';
        switch($device){
            case "desktop": $icon= 'fas fa-desktop'; break;
            case "phone": $icon= 'fas fa-mobile-alt'; break;
            case "tablet": $icon= 'fas fa-tablet-alt'; break;
            case "robot": $icon= 'fas fa-robot';break;
            default: $icon= 'fas fa-question';break;
        }
        return $icon;
    }

    /**
    * Get Browser icon
    * @return string
    */
    public function getBrowserIconAttribute(){
        $os= $this->agent->browser();
        $icon= '';
        switch($os){
            case "Opera Mini": $icon= 'fab fa-opera'; break;
            case "Opera": $icon= 'fab fa-opera'; break;
            case "Chrome": $icon= 'fab fa-chrome';break;
            case "Mozilla": $icon= 'fab fa-firefox'; break;
            case "Firefox": $icon= 'fab fa-firefox'; break;
            case "IE": $icon= 'fab fa-internet-explorer'; break;
            case "Edge": $icon= 'fab fa-edge';break;
            default: ;
        }
        return $icon;
    }

    /**
    * Return 'last_activity' description
    * @return string
    */
    public function getActivityAttribute()
    {
        return Carbon::createFromTimestamp($this->last_activity)->diffForHumans();
    }


}
