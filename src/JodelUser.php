<?php
namespace JWhy\JodelPHP;

class JodelUser
{

    private $latitude, $longitude, $loc_accuracy, $city, $country, $client_id, $device_uid, $access_token;

    /**
     *
     * @param num $latitude
     *            the latitude coordinate
     * @param num $longitude
     *            the longitude coordinate
     * @param string $loc_accuracy
     *            the location accuracy (optional)
     * @param string $city
     *            the user's city (optional)
     * @param string $country
     *            2-letter country code (optional)
     * @param string $device_uid
     *            the device UID (optional)
     */
    function __construct($latitude, $longitude, $loc_accuracy = '19', $city = 'Bremen', $country = 'DE', $device_uid = NULL, $access_token = NULL)
    {
        $this->set_geo_coordinates($latitude, $longitude, $loc_accuracy);
        $this->set_city($city);
        $this->set_country($country);
        $this->set_access_token($access_token);
        
        $this->set_client_id('81e8a76e-1e02-4d17-9ba0-8a7020261b26');
        $this->set_device_uid(($device_uid != NULL) ? $device_uid : $this->generate_device_uid());
    }

    /**
     * Returns the user's access token.
     *
     * @return string $access_token the user's access token
     */
    public function get_access_token()
    {
        return $this->access_token;
    }

    /**
     * Returns the user's latitude.
     *
     * @return the user's latitude
     */
    public function get_latitude()
    {
        return $this->latitude;
    }

    /**
     * Returns the user's longitude.
     *
     * @return num the user's longitude
     */
    public function get_longitude()
    {
        return $this->longitude;
    }

    /**
     * Returns the user's country code.
     *
     * @return string the user's country code
     */
    public function get_country()
    {
        return $this->country;
    }

    /**
     * Returns the user's latitude.
     *
     * @param num $latitude
     *            the user's latitude
     */
    public function set_latitude($latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * Sets the user's latitude.
     *
     * @param num $longitude
     *            the user's longitude
     */
    public function set_longitude($longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     * Sets the user's country.
     *
     * @param string $country
     *            two letter country code (ex. 'DE')
     */
    public function set_country($country)
    {
        $this->country = $country;
    }

    /**
     * Returns the user's city.
     *
     * @return string the user's city
     */
    public function get_city()
    {
        return $this->city;
    }

    /**
     * Returns the user's client ID.
     *
     * @return string $client_id
     */
    public function get_client_id()
    {
        return $this->client_id;
    }

    /**
     * Return the user device's UID.
     *
     * @return string $device_uid the user device's UID
     */
    public function get_device_uid()
    {
        return $this->device_uid;
    }

    /**
     * Sets the user's access token.
     *
     * @param string $access_token
     *            the user's access token
     */
    public function set_access_token($access_token)
    {
        $this->access_token = $access_token;
    }

    /**
     * Sets the user's city.
     *
     * @param string $city            
     */
    public function set_city($city)
    {
        $this->city = $city;
    }

    /**
     * Sets the user's client ID.
     *
     * @param string $client_id            
     */
    public function set_client_id($client_id)
    {
        $this->client_id = $client_id;
    }

    /**
     * Sets the user device's UID.
     *
     * @param string $device_uid            
     */
    public function set_device_uid($device_uid)
    {
        $this->device_uid = $device_uid;
    }

    public function set_geo_coordinates($latitude, $longitude, $loc_accuracy = 19)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->loc_accuracy = $loc_accuracy;
    }

    /**
     * Returns the location data.
     *
     * @return array the location data
     */
    public function get_location()
    {
        return array(
            'loc_accuracy' => $this->loc_accuracy,
            'city' => $this->city,
            'loc_coordinates' => array(
                'lat' => $this->latitude,
                'lng' => $this->longitude
            ),
            'country' => $this->country
        );
    }

    /**
     * Returns a random Device UID.
     *
     * @return string the device UID
     */
    public function generate_device_uid()
    {
        $length = 63;
        $random = '';
        for ($i = 0; $i < $length; $i ++) {
            // add a number or a lowercase letter
            $random .= rand(0, 1) ? rand(0, 9) : chr(rand(ord('a'), ord('z')));
        }
        return $random;
    }

    /**
     * Returns whether the user is registered to the API server.
     * If users have an access token, they are assumably registered.
     */
    public function is_registered()
    {
        return $this->get_access_token() != NULL;
    }
}

?>