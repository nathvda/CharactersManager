import React from 'react'
import ReactDOM from 'react-dom/client'
import Home from './components/Home'
import Error from './components/Error'
import Characters from './components/Characters'
import Threads from './components/Threads'
import NewThread from './components/NewThread'
import NewCharacter from './components/NewCharacter'
import { createBrowserRouter, RouterProvider } from 'react-router-dom';
import './assets/scss/style.scss';
import DisplayCharacter from './components/DisplayCharacter'

const router = createBrowserRouter([
  {
    path:"/",
    element: <Home />,
    errorElement: <Error />,
    children: [
      {
      path: "characters",
      element: <Characters />,
      errorElement: <Error />,
      children:[
        {
          path: ":id",
          element: <DisplayCharacter />,
          errorElement: <Error />,
        }
      ]
    },
    {
      path: "threads",
      element: <Threads />,
      errorElement: <Error />,
    },
    {
      path: "newcharacter",
      element: <NewCharacter />,
      errorElement: <Error />,
    },
    {
      path: "newthread",
      element: <NewThread />,
      errorElement: <Error />,
    }
  ],
  },
  {
    path:"/Error",
    element: <Error />,
    errorElement: <Error />
  },
]);

ReactDOM.createRoot(document.getElementById('root')).render(
  <React.StrictMode>
  <RouterProvider router={router}/>
  </React.StrictMode>
)
