import React, { useEffect, useState } from 'react';
import axios from 'axios';

const Threads = () => {

    const [threads, setThreads] = useState([]);

    useEffect(() => 
    async function getThreads(){

        try {
            const res = await axios.get('http://localhost:8787/threads');
            const data = await res.data;

            setThreads(data);

        } catch (error) {
            console.log(error);
        }

    }
    , [] );

    return (
        <>
            <h2>Threads</h2> 
            <table>
                <thead>
                <tr>
                    <th>Titre</th>
                    <th>Character</th>
                    </tr>
                </thead>
                <tbody>
            {
            threads.map((a,index) => <tr key={index}>
                <td><a href={a.url} target="_blank">WWW</a> {a.title}</td>
                <td>{a.char_name}</td>

            </tr>
            )
            }</tbody>
            </table>
        </>
    );
};

export default Threads;