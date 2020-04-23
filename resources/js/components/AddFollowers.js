import React, { useState } from 'react';

const AddFollowers = props => {
    const [value, setValue] = useState(0);
    const [disabled, setDisabled] = useState(true);

    const handleChange = e => {
        setValue(e.target.value);
        setDisabled(false);
    };

    return (
        <div className="form-group">
            <label htmlFor="add-follower">Add Follower: </label>
            <select name="add-follower" id="add-follower" className="form-control" onChange={handleChange} defaultValue={'0'}>
                <option value="0" disabled>Choose someone to follow:</option>
                {props.users.map((user, i) => <option value={user.id} key={i}>{user.name}</option>)}
            </select>
            <br /><button type="button" id="follow-user__button" className="btn btn-sm btn-primary" disabled={disabled} onClick={() => props.followUser(value)}>Follow</button>
        </div>
    );
};

export default AddFollowers;
