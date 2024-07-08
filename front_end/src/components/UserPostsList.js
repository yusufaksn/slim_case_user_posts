import React, { useState, useEffect } from 'react';
import './UserPostsList.css';
const UserPostsList = () => {
    const [posts, setPosts] = useState([]);

    useEffect(() => {
        const fetchPosts = async () => {
            try {
                const response = await fetch('http://localhost:8006/api/user-post');
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                const data = await response.json();
                setPosts(data);
            } catch (error) {
                console.error('Error fetching data:', error);
            }
        };

        fetchPosts();
    }, []);

    const handleDelete = async (postId) => {
        console.log("postId", postId)
        try {
            const response = await fetch(`http://localhost:8006/api/user-post/${postId}`, {
                method: 'DELETE',
            });
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            // Remove the deleted post from state
            setPosts(posts.filter(post => post.id !== postId));
        } catch (error) {
            console.error('Error deleting post:', error);
        }
    };

    return (
        <div>
            <h2>User Posts</h2>
            <table className="table-container">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Body</th>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                {posts.map((post) => (
                    <tr key={post.id}>
                        <td>{post.title}</td>
                        <td>{post.body}</td>
                        <td>{post.username}</td>
                        <td>
                            <button className="delete-button" onClick={() => handleDelete(post.id)}>Delete</button>
                        </td>
                    </tr>
                ))}
                </tbody>
            </table>
        </div>
    );
};

export default UserPostsList;