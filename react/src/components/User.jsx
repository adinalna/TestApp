import React, { useState, useEffect } from 'react';
import axiosClient from "../../axios-client.js";
import { Button, Modal, Form } from 'react-bootstrap';

export default function Users() {
    const [userList, setUserList] = useState([]);
    const [showEditModal, setShowEditModal] = useState(false);
    const [editUserId, setEditUserId] = useState(null);
    const [editFormData, setEditFormData] = useState({
        name: "",
        email: "",
    });

    const [addFormData, setAddFormData] = useState({
        name: "",
        email: "",
        password: "",
    });


    useEffect(() => {
        fetchUserList();
    }, []);

    const fetchUserList = async () => {
        try {
            const response = await axiosClient.get(`users/all`);
            const list = response.data;
            setUserList(list);
        } catch (error) {
            console.error(error);
        }
    };

    const handleAddUser = async () => {
        try {
            const response = await axiosClient.post(`users/add`, addFormData);
            const newUser = response.data;

            setUserList([...userList, newUser]); // Add the new user to the list
        } catch (error) {
            console.error(error);
        }
    };

    const handleEdit = (userId) => {
        setEditUserId(userId);
        // Fetch the user's data based on userId and populate the form data
        const userToEdit = userList.find((user) => user.id === userId);
        if (userToEdit) {
            setEditFormData({
                name: userToEdit.name,
                email: userToEdit.email,
            });
        }
        setShowEditModal(true);
    };

    const handleDelete = (userId) => {
        const userToDelete = userList.find((user) => user.id === userId);
        const confirmDelete = window.confirm(`Are you sure you want to delete?\nUser: ${userToDelete.name}\nEmail: ${userToDelete.email}`);

        if (confirmDelete) {
            try {
                axiosClient.delete(`users/${userId}/delete`);
                // Update the user list by removing the deleted user
                const updatedList = userList.filter((user) => user.id !== userId);
                setUserList(updatedList);
            } catch (error) {
                console.error(error);
            }
        }
    };

    const handleSaveChanges = async () => {
        try {
            await axiosClient.put(`users/${editUserId}/update`, {
                name: editFormData.name,
                email: editFormData.email,
            });

            const updatedList = userList.map((user) => {
                if (user.id === editUserId) {
                    return {
                        ...user,
                        name: editFormData.name,
                        email: editFormData.email,
                    };
                }
                return user;
            });
            setUserList(updatedList);
        } catch (error) {
            console.error(error);
        }

        setShowEditModal(false);
    };

    return (
        <div className='default-container'>
            <h2>Users</h2>
            <table className="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    {userList.map((user) => (
                        <tr key={user.id}>
                            <td>{user.name}</td>
                            <td>{user.email}</td>
                            <td>
                                <Button variant="primary" onClick={() => handleEdit(user.id)}>Edit</Button>
                                {' '}
                                <Button variant="danger" onClick={() => handleDelete(user.id)}>Delete</Button>
                            </td>
                        </tr>
                    ))}
                </tbody>
            </table>

            {/* Add User Form */}
            <h2>Add Users</h2>
            <Form>
                <Form.Group controlId="name">
                    <Form.Label>Name</Form.Label>
                    <Form.Control
                        type="text"
                        value={addFormData.name}
                        onChange={(e) => setAddFormData({ ...addFormData, name: e.target.value })}
                    />
                </Form.Group>
                <Form.Group controlId="email">
                    <Form.Label>Email</Form.Label>
                    <Form.Control
                        type="email"
                        value={addFormData.email}
                        onChange={(e) => setAddFormData({ ...addFormData, email: e.target.value })}
                    />
                </Form.Group>
                <Form.Group controlId="password">
                    <Form.Label>Password</Form.Label>
                    <Form.Control
                        type="password"
                        value={addFormData.password}
                        onChange={(e) => setAddFormData({ ...addFormData, password: e.target.value })}
                    />
                </Form.Group>
                <Button variant="primary" onClick={handleAddUser}>
                    Add User
                </Button>
            </Form>

            {/* Edit Modal */}
            <Modal show={showEditModal} onHide={() => setShowEditModal(false)}>
                <Modal.Header closeButton>
                    <Modal.Title>Edit User</Modal.Title>
                </Modal.Header>
                <Modal.Body>
                    <Form>
                        <Form.Group controlId="name">
                            <Form.Label>Name</Form.Label>
                            <Form.Control
                                type="text"
                                value={editFormData.name}
                                onChange={(e) => setEditFormData({ ...editFormData, name: e.target.value })}
                            />
                        </Form.Group>
                        <Form.Group controlId="email">
                            <Form.Label>Email</Form.Label>
                            <Form.Control
                                type="email"
                                value={editFormData.email}
                                onChange={(e) => setEditFormData({ ...editFormData, email: e.target.value })}
                            />
                        </Form.Group>
                    </Form>
                </Modal.Body>
                <Modal.Footer>
                    <Button variant="secondary" onClick={() => setShowEditModal(false)}>
                        Close
                    </Button>
                    <Button variant="primary" onClick={handleSaveChanges}>
                        Save Changes
                    </Button>
                </Modal.Footer>
            </Modal>
        </div>
    );
}
