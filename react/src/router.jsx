import { Navigate, createBrowserRouter } from "react-router-dom";
import User from "./components/User.jsx";
import NotFound from "./components/NotFound.jsx";


const router = createBrowserRouter([
    {
        path: '/users',
        element: <User />,
    },
    {
        path: '*',
        element: <NotFound />
    }
])


export default router;