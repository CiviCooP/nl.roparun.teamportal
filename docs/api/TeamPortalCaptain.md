# TeamPortalCaptains.get

List all active team captains.

The following information is returned

* Name
* Role
* Woonplaats
* Email address
* Team name
* Team nr.
* contact_id _contact if of the captain_
* event_id _id of the event in civicrm for which this person is team captain_
* participant_id _id of participant record in civicrm_
* team_id _is the contact id of the team_

### Parameters

Optional parameters


| Parameter                   | Default value        | Description |
+-----------------------------+----------------------+-------------|
| event_id                    | current roparun event|             |

### How to use?

An api call loooks like:

````
http://roparun.local.com/sites/all/modules/civicrm/extern/rest.php?entity=TeamPortalCaptains&action=get&api_key=userkey&key=sitekey
````

Resultaat ziet er zo uit:
````
     {


    "is_error": 0,
    "version": 3,
    "count": 1,
    "id": 25,
    "values": [
        {
            "contact_id": "987",
            "participant_id": "13",
            "event_id": "1",
            "name": "Jan Jansen",
            "city": "Amsterdam",
            "role": "Teamcaptain",
            "email": janjansen@example.com,
            "team_id": "25",
            "team": "Team CiviCooP",
            "teamnr": "46"
        }
    ]
}
````