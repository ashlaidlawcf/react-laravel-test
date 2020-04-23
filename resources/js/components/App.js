import React, { useState, useEffect, useRef } from 'react';
import ReactDOM from 'react-dom';
import Axios from 'axios';
import AddFollowers from './AddFollowers';
import Following from './Following';

const App = () => {
    const [areUsersLoaded, setAreUsersLoaded] = useState(false);
    const [users, setUsers] = useState([]);
    const [isLoaded, setIsLoaded] = useState(false);
    const [following, setFollowing] = useState([]);

    useEffect(() => {
        Axios.get('api/v1/user').then(response => {
            if (response.data) {
                setAreUsersLoaded(true);
                setUsers(response.data);
            }
        });
    }, []);

    useEffect(() => {
        Axios.get('api/v1/following').then(response => {
            if (response.data) {
                setIsLoaded(true);
                setFollowing(response.data);
            }
        });
    }, []);

    const followUser = val => {
        Axios.post('api/v1/following', {
            user_id: val
        }).then(response => {
            let newFollowing = [...following];
            newFollowing.push(response.data[0]);

            setFollowing(newFollowing);
        });
    };

    const unfollowUser = val => {
        Axios.post('api/v1/unfollow', {
            user_id: val
        }).then(response => {
            let newFollowing = following.filter(user => user.id !== response.data);

            setFollowing(newFollowing);
        });
    };

    return (
        <React.Fragment>
            <Following
                isLoaded={isLoaded}
                following={following}
                unfollowUser={unfollowUser}
            />
            <AddFollowers
                areUsersLoaded={areUsersLoaded}
                users={users}
                followUser={followUser}
            />
        </React.Fragment>
    );
}

export default App;

if (document.getElementById('main-content')) {
    ReactDOM.render(<App />, document.getElementById('main-content'));
}
