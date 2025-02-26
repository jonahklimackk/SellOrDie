<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tailwind CSS Table</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="container mx-auto">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">ID</th>
                        <th class="py-3 px-6 text-left">Name</th>
                        <th class="py-3 px-6 text-left">Email</th>
                        <th class="py-3 px-6 text-left">Role</th>
                        <th class="py-3 px-6 text-left">Department</th>
                        <th class="py-3 px-6 text-left">Phone</th>
                        <th class="py-3 px-6 text-left">Location</th>
                        <th class="py-3 px-6 text-left">Status</th>
                        <th class="py-3 px-6 text-left">Joining Date</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6">1</td>
                        <td class="py-3 px-6">John Doe</td>
                        <td class="py-3 px-6">john@example.com</td>
                        <td class="py-3 px-6">Admin</td>
                        <td class="py-3 px-6">IT</td>
                        <td class="py-3 px-6">123-456-7890</td>
                        <td class="py-3 px-6">New York</td>
                        <td class="py-3 px-6">Active</td>
                        <td class="py-3 px-6">2021-05-10</td>
                    </tr>
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6">2</td>
                        <td class="py-3 px-6">Jane Smith</td>
                        <td class="py-3 px-6">jane@example.com</td>
                        <td class="py-3 px-6">Editor</td>
                        <td class="py-3 px-6">Marketing</td>
                        <td class="py-3 px-6">987-654-3210</td>
                        <td class="py-3 px-6">Los Angeles</td>
                        <td class="py-3 px-6">Inactive</td>
                        <td class="py-3 px-6">2020-09-15</td>
                    </tr>
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6">3</td>
                        <td class="py-3 px-6">Michael Johnson</td>
                        <td class="py-3 px-6">michael@example.com</td>
                        <td class="py-3 px-6">User</td>
                        <td class="py-3 px-6">Finance</td>
                        <td class="py-3 px-6">456-789-0123</td>
                        <td class="py-3 px-6">Chicago</td>
                        <td class="py-3 px-6">Active</td>
                        <td class="py-3 px-6">2019-11-20</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>