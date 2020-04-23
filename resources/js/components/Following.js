import React from 'react';

const Following = props => {
    const styles = {
        cursor: 'pointer'
    };

    if (props.isLoaded) {
        if (props.following.length === 0) {
            return <div>You are not following anyone.<br /><br /></div>;
        }

        return (
            <div>
                <p>You are following:</p>
                <ul>
                    {props.following.map(result => (
                        <li key={result.id}>
                            <span style={styles} onClick={() => props.unfollowUser(result.id)}>{result.name}</span> <small>Click to unfollow</small>
                        </li>
                    ))}
                </ul>
            </div>
        );
    }

    return <div>Loading...</div>;
};

export default Following;
