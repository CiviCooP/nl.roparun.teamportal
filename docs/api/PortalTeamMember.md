# PortalTeamMember.get

List all members of a team. 

The following information is returned

* Display name
* Phone
* Email
* Address
* City
* Country
* Role
* is_active _1 when member is currently on the team, 0 when member has been on the team_
* id _contact if of the captain_
* event_id _id of the event in civicrm for which this person is team captain_
* team_id _is the contact id of the team_

### Parameters


| Parameter                   | Required |Default value         | Description |
+-----------------------------+----------+----------------------+-------------|
| team_id                     | required |                      |             |
| event_id                    |          | current roparun event|             |
| is_active                   |          |                      | When set filters on whether to return active or inactive team members |
| role                        |          |                      | Filters on the role | 

### How to use?

An api call loooks like:

````
http://roparun.local.com/sites/all/modules/civicrm/extern/rest.php?entity=PortalTeamMembern&action=get&api_key=userkey&key=sitekey&team_id=25
````

The result looks like:
````
     {


    "is_error": 0,
    "version": 3,
    "count": 2,
    "values": [
                {
            "id": "986",
            "team_id": "25",
            "is_active": "1",
            "event_id": "1",
            "display_name": "John Smith",
            "phone": "",
            "email": "",
            "address": " ",
            "postal_code": "",
            "city": "Alblasserdam",
            "country": "",
            "role": "Loper"
        },
        {
            "id": "1030",
            "team_id": "25",
            "is_active": "1",
            "event_id": "1",
            "display_name": "Cathy Jackson",
            "phone": "",
            "email": "",
            "address": " ",
            "postal_code": "",
            "city": "Hillegom",
            "country": "Nederland",
            "role": "Fietser"
        },
    ]
}
````