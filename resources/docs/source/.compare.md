---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/docs/collection.json)

<!-- END_INFO -->

#general


<!-- START_96e171215c9a2ad89492003bac368ad1 -->
## Get only untrashed user types.

[Returns user type data by given id but returns only users that are not soft deleted.]

> Example request:

```bash
curl -X GET \
    -G "/user-type/without-trashed/1?id=et" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "/user-type/without-trashed/1"
);

let params = {
    "id": "et",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "content": {
        "user_type": {
            "id": 7,
            "name": "test user type",
            "deleted_at": null,
            "created_at": "2019-11-15 13:55:45",
            "updated_at": "2019-11-15 13:55:45"
        }
    },
    "error_messages": []
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "id": [
            "The selected id is invalid."
        ]
    }
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "id": [
            "The id must be an integer."
        ]
    }
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "error": "The selected id is invalid."
    }
}
```

### HTTP Request
`GET /user-type/without-trashed/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `id` |  required  | id of a user type

<!-- END_96e171215c9a2ad89492003bac368ad1 -->

<!-- START_02eb515dadd92480ab4689226b5b06f4 -->
## Get user types including trashed ones.

[Returns user type data by given id, returns also soft deleted user types.]

> Example request:

```bash
curl -X GET \
    -G "/user-type/with-trashed/1?id=modi" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "/user-type/with-trashed/1"
);

let params = {
    "id": "modi",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "content": {
        "user_type": {
            "id": 7,
            "name": "test user type",
            "deleted_at": null,
            "created_at": "2019-11-15 13:55:45",
            "updated_at": "2019-11-15 13:55:45"
        }
    },
    "error_messages": []
}
```
> Example response (200):

```json
{
    "content": {
        "user_type": {
            "id": 4,
            "name": "some user type",
            "deleted_at": "2019-11-15 13:10:33",
            "created_at": "2019-11-15 12:41:36",
            "updated_at": "2019-11-15 13:10:33"
        }
    },
    "error_messages": []
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "id": [
            "The selected id is invalid."
        ]
    }
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "id": [
            "The id must be an integer."
        ]
    }
}
```

### HTTP Request
`GET /user-type/with-trashed/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `id` |  required  | id of a user type

<!-- END_02eb515dadd92480ab4689226b5b06f4 -->

<!-- START_54d1da13bd8a0738023f293ae3811f3e -->
## Get submission.

[Returns submission by given id]

> Example request:

```bash
curl -X GET \
    -G "/submission/1?id=voluptatum" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "/submission/1"
);

let params = {
    "id": "voluptatum",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "content": {
        "submission": {
            "id": 2,
            "name": "name awesome",
            "surname": "Kowalski",
            "phone": "0700880788",
            "email": "another@email.com",
            "developer_type": 8,
            "developer_skill": 7,
            "linked_in_profile": "linked_in_profile",
            "github_profile": "http:\/\/www.github.com\/czesiukowalski",
            "description": "awesome developer",
            "files": "{\"file\": \"somefile.txt\"}",
            "submission_type": 1,
            "created_at": "2019-11-15 12:13:33",
            "updated_at": "2019-11-15 12:13:33"
        }
    },
    "error_messages": []
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "id": [
            "The selected id is invalid."
        ]
    }
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "id": [
            "The id must be an integer."
        ]
    }
}
```

### HTTP Request
`GET /submission/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `id` |  required  | id of a submission

<!-- END_54d1da13bd8a0738023f293ae3811f3e -->

<!-- START_24d72d9fa8d492dbfe3d592ff3f3352b -->
## Create new user type.

[ Create new user type. ]

> Example request:

```bash
curl -X POST \
    "/user-type" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"sit"}'

```

```javascript
const url = new URL(
    "/user-type"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "sit"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "content": {
        "user_type": {
            "name": "some name",
            "updated_at": "2019-11-15 12:39:00",
            "created_at": "2019-11-15 12:39:00",
            "id": 3
        }
    },
    "error_messages": []
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "name": [
            "The name field is required."
        ]
    }
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "name": [
            "The name has already been taken."
        ]
    }
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "name": [
            "The name must be at least 3 characters."
        ]
    }
}
```

### HTTP Request
`POST /user-type`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `name` | string |  required  | Name of a user type. Must contain between 3 - 167 characters and must be unique. Two or more exacly the same names are not allowed.
    
<!-- END_24d72d9fa8d492dbfe3d592ff3f3352b -->

<!-- START_f7df20e11f866ce328623f1255e6a6b7 -->
## Create new submission.

[ Create new submission. ]

> Example request:

```bash
curl -X POST \
    "/submission" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"eos","surname":"repudiandae","phone":"inventore","email":"eligendi","developer_type":19,"developer_skill":14,"linked_in_profile":"omnis","github_profile":"blanditiis","description":"nulla","files":"odio","submission_type":13}'

```

```javascript
const url = new URL(
    "/submission"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "eos",
    "surname": "repudiandae",
    "phone": "inventore",
    "email": "eligendi",
    "developer_type": 19,
    "developer_skill": 14,
    "linked_in_profile": "omnis",
    "github_profile": "blanditiis",
    "description": "nulla",
    "files": "odio",
    "submission_type": 13
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "content": {
        "submission": {
            "name": "Czesiu",
            "surname": "Kowalski",
            "phone": "0700880788",
            "developer_type": "8",
            "developer_skill": "7",
            "linked_in_profile": "linked_in_profile",
            "github_profile": "http:\/\/www.github.com\/czesiukowalski",
            "description": "awesome developer",
            "submission_type": "1",
            "files": "{\"file\":\"somefile.txt\"}",
            "email": "czesiu@gmail.com",
            "updated_at": "2019-11-15 12:09:10",
            "created_at": "2019-11-15 12:09:10",
            "id": 1
        }
    },
    "error_messages": []
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "name": [
            "The name field is required."
        ]
    }
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "email": [
            "The email has already been taken."
        ]
    }
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "email": [
            "The email format is invalid."
        ]
    }
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "email": [
            "The email has already been taken."
        ]
    }
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "phone": [
            "The phone format is invalid."
        ]
    }
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "submission_type": [
            "The selected submission type is invalid."
        ]
    }
}
```

### HTTP Request
`POST /submission`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `name` | string |  required  | min:3 max:167  name of a user.
        `surname` | string |  required  | min:3 max:167 - surname of a user.
        `phone` | phone-number |  required  | phone number - minimum 7 characters.
        `email` | email |  required  | email mus be unique - cannot be used by anyone else.
        `developer_type` | integer |  required  | type of a developer.
        `developer_skill` | integer |  required  | skill of a developer.
        `linked_in_profile` | string |  required  | linked in profile.
        `github_profile` | string |  required  | github profile.
        `description` | string |  required  | description.
        `files` | json |  required  | files.
        `submission_type` | integer |  required  | exists:user_types,id  id of a submission.
    
<!-- END_f7df20e11f866ce328623f1255e6a6b7 -->

<!-- START_5f93d051556723db66cef9b8b43afb14 -->
## Update user type.

[Update user type by given id]

> Example request:

```bash
curl -X PUT \
    "/user-type" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"id":18,"name":"dicta"}'

```

```javascript
const url = new URL(
    "/user-type"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "id": 18,
    "name": "dicta"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "content": {
        "user_type": {
            "id": 7,
            "name": "testing",
            "deleted_at": null,
            "created_at": "2019-11-15 13:55:45",
            "updated_at": "2019-11-15 14:59:29"
        }
    },
    "error_messages": []
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "id": [
            "The selected id is invalid."
        ]
    }
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "id": [
            "The id must be an integer."
        ]
    }
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "name": [
            "The name field is required."
        ]
    }
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "name": [
            "The name must be at least 3 characters."
        ]
    }
}
```

### HTTP Request
`PUT /user-type`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `id` | integer |  required  | Id of a user type you want to update.
        `name` | string |  required  | User type name you want to update. Must contain 3-167 characters.
    
<!-- END_5f93d051556723db66cef9b8b43afb14 -->

<!-- START_2bbfe154347aedf0f5a1ff314636742f -->
## Restore trashed user type.

[Restore user type that has been soft deleted.]

> Example request:

```bash
curl -X PUT \
    "/user-type/restore" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"id":15}'

```

```javascript
const url = new URL(
    "/user-type/restore"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "id": 15
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "content": {
        "user_type": {
            "id": 4,
            "name": "some user type",
            "deleted_at": null,
            "created_at": "2019-11-15 12:41:36",
            "updated_at": "2019-11-15 14:17:53"
        }
    },
    "error_messages": []
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "id": [
            "The selected id is invalid."
        ]
    }
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "id": [
            "The id must be an integer."
        ]
    }
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "error": "The user is not soft deleted"
    }
}
```

### HTTP Request
`PUT /user-type/restore`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `id` | integer |  required  | Id of a soft deleted user type
    
<!-- END_2bbfe154347aedf0f5a1ff314636742f -->

<!-- START_805823463471ea5c3163cb80ceebf961 -->
## Update submission.

[Update submission by given id. Include key value pairs you want to update]

> Example request:

```bash
curl -X PUT \
    "/submission" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"id":6,"name":"odit","surname":"expedita","phone":"esse","email":"vero","developer_type":3,"developer_skill":19,"linked_in_profile":"sit","github_profile":"rem","description":"quasi","files":"maxime","submission_type":10}'

```

```javascript
const url = new URL(
    "/submission"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "id": 6,
    "name": "odit",
    "surname": "expedita",
    "phone": "esse",
    "email": "vero",
    "developer_type": 3,
    "developer_skill": 19,
    "linked_in_profile": "sit",
    "github_profile": "rem",
    "description": "quasi",
    "files": "maxime",
    "submission_type": 10
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "content": {
        "submission": {
            "id": 2,
            "name": "testing update",
            "surname": "Kowalski",
            "phone": "0700880788",
            "email": "another@email.com",
            "developer_type": 8,
            "developer_skill": 7,
            "linked_in_profile": "linked_in_profile",
            "github_profile": "http:\/\/www.github.com\/czesiukowalski",
            "description": "awesome developer",
            "files": "{\"file\": \"somefile.txt\"}",
            "submission_type": 1,
            "created_at": "2019-11-15 12:13:33",
            "updated_at": "2019-11-15 14:41:06"
        }
    },
    "error_messages": []
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "id": [
            "The selected id is invalid."
        ]
    }
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "id": [
            "The id must be an integer."
        ]
    }
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "email": [
            "The email has already been taken."
        ]
    }
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "email": [
            "The email format is invalid."
        ]
    }
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "phone": [
            "The phone format is invalid."
        ]
    }
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "submission_type": [
            "The selected submission type is invalid."
        ]
    }
}
```

### HTTP Request
`PUT /submission`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `id` | integer |  required  | id of a submission you want to update.
        `name` | string |  optional  | name of a user, must contain between 3 - 167 characters.
        `surname` | string |  optional  | surname of a user, must contain between 3 - 167 characters.
        `phone` | phone-number |  optional  | phone number - minimum 7 characters.
        `email` | email |  optional  | must be unique - cannot be used by anyone else.
        `developer_type` | integer |  optional  | type of a developer.
        `developer_skill` | integer |  optional  | skill of a developer.
        `linked_in_profile` | string |  optional  | linked in profile.
        `github_profile` | string |  optional  | github profile.
        `description` | string |  optional  | description.
        `files` | json |  optional  | files.
        `submission_type` | integer |  optional  | an existing key of a user type
    
<!-- END_805823463471ea5c3163cb80ceebf961 -->

<!-- START_8cf8af5ca8a9040a3e010da8a0d3933b -->
## Soft delete user type.

[To soft delete a user type means it won't be visible for query GET /user-type/without-trashed, however it is still visible for query GET /user-type/with-trashed/{id}. It also means it can be restored and still phisically exists in the database]

> Example request:

```bash
curl -X DELETE \
    "/delete/soft/user-type" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"id":11}'

```

```javascript
const url = new URL(
    "/delete/soft/user-type"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "id": 11
}

fetch(url, {
    method: "DELETE",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "content": {
        "user_type": {
            "id": 4,
            "name": "some user type",
            "deleted_at": "2019-11-15 13:10:33",
            "created_at": "2019-11-15 12:41:36",
            "updated_at": "2019-11-15 13:10:33"
        }
    },
    "error_messages": []
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "id": [
            "The selected id is invalid."
        ]
    }
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "id": [
            "The id must be an integer."
        ]
    }
}
```

### HTTP Request
`DELETE /delete/soft/user-type`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `id` | integer |  required  | An id of a user type
    
<!-- END_8cf8af5ca8a9040a3e010da8a0d3933b -->

<!-- START_d5d987114566f95d2d84f32b67dc21e0 -->
## Hard delete user type.

[ To hard delete a user type means it is impossible to restore it. A row is physically deleted from the database]

> Example request:

```bash
curl -X DELETE \
    "/delete/hard/user-type" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"id":9}'

```

```javascript
const url = new URL(
    "/delete/hard/user-type"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "id": 9
}

fetch(url, {
    method: "DELETE",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "content": {
        "user_type": {
            "id": 6,
            "name": "some user type",
            "deleted_at": null,
            "created_at": "2019-11-15 12:54:29",
            "updated_at": "2019-11-15 12:54:29"
        }
    },
    "error_messages": []
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "id": [
            "The selected id is invalid."
        ]
    }
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "id": [
            "The id must be an integer."
        ]
    }
}
```

### HTTP Request
`DELETE /delete/hard/user-type`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `id` | integer |  required  | An id of a user type
    
<!-- END_d5d987114566f95d2d84f32b67dc21e0 -->

<!-- START_4b42abbd3cbb459994a237d3d0c78170 -->
## Delete submission.

[Deletes submission with given id]

> Example request:

```bash
curl -X DELETE \
    "/delete/submission" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"id":11}'

```

```javascript
const url = new URL(
    "/delete/submission"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "id": 11
}

fetch(url, {
    method: "DELETE",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "content": {
        "submission": {
            "id": 1,
            "name": "Czesiu",
            "surname": "Kowalski",
            "phone": "0700880788",
            "email": "czesiu@gmail.com",
            "developer_type": 8,
            "developer_skill": 7,
            "linked_in_profile": "linked_in_profile",
            "github_profile": "http:\/\/www.github.com\/czesiukowalski",
            "description": "awesome developer",
            "files": "{\"file\": \"somefile.txt\"}",
            "submission_type": 1,
            "created_at": "2019-11-15 12:09:10",
            "updated_at": "2019-11-15 12:09:10"
        }
    },
    "error_messages": []
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "id": [
            "The selected id is invalid."
        ]
    }
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "id": [
            "The id must be an integer."
        ]
    }
}
```

### HTTP Request
`DELETE /delete/submission`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `id` | integer |  required  | An id of a submission
    
<!-- END_4b42abbd3cbb459994a237d3d0c78170 -->


